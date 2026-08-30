#!/usr/bin/env python3
"""
Extracts header/footer (once) and per-page title/meta/body/form-fields
from the existing static HTML site into JSON that a Laravel seeder
consumes. Content is copied verbatim -- no rewriting, no paraphrasing.
"""
import json
import re
from pathlib import Path
from bs4 import BeautifulSoup

ROOT = Path(__file__).resolve().parent.parent.parent  # repo root (one above cms/)
OUT_DIR = Path(__file__).resolve().parent / "extracted"
OUT_DIR.mkdir(exist_ok=True)

PAGES = [
    "index.html", "contact.html", "consulting.html", "equipments.html",
    "freezing.html", "heating.html", "service.html", "spare_parts.html",
    "knowledge-articles.html", "knowledge-videos.html",
    "process/blanching.html", "process/cutting.html", "process/dicing.html",
    "process/more_machines.html", "process/peeling.html", "process/slicing.html",
    "process/used-equipments.html", "process/washing.html",
    "sorting/conveyors.html", "sorting/others.html", "sorting/sorting.html",
    "freezing/freezing.html", "freezing/impingement.html", "freezing/spiral.html",
    "heating/filteration.html", "heating/grill.html", "heating/oven.html",
    "service/equipment-audits.html", "service/online-support.html", "service/onsite-support.html",
]

FIELD_TYPE_MAP = {
    "text": "text", "email": "email", "tel": "tel",
}

# The new app routes pages by slug without ".html" (e.g. /process/cutting
# instead of /process/cutting.html). Internal links are structural, not
# content, so rewriting them to match the new routing is not a content
# change -- it's what keeps navigation from 404ing.
HREF_HTML_RE = re.compile(r'href="(/[^"]*?)\.html"')
# Relative asset paths (images/..., css/...) break once served from a
# nested route like /process/blanching -- make them root-relative.
RELATIVE_ASSET_RE = re.compile(r'(src|href)="(images|css|fonts|js)/')


def rewrite_internal_links(html: str) -> str:
    def repl(match):
        path = match.group(1)
        if path == "/index":
            path = "/"
        return f'href="{path}"'
    html = HREF_HTML_RE.sub(repl, html)
    html = RELATIVE_ASSET_RE.sub(r'\1="/\2/', html)
    return html


def extract_form_fields(form_tag):
    fields = []
    if not form_tag:
        return fields
    order = 0
    for el in form_tag.find_all(["input", "select", "textarea"]):
        name = el.get("name")
        if not name or name in ("_field_list",):
            continue
        el_type = (el.get("type") or "").lower()
        if el.name == "input" and el_type in ("submit", "button", "hidden", "file"):
            if el_type == "hidden" and name == "page_source":
                continue
            if el_type != "file":
                continue
        order += 1
        label_tag = el.find_parent(class_="gbase-form-group")
        label_text = None
        if label_tag:
            label_el = label_tag.find("label")
            if label_el:
                label_text = label_el.get_text(strip=True).rstrip("*").strip()
        if not label_text:
            label_text = name.replace("_", " ").title()

        if el.name == "textarea":
            ftype = "textarea"
        elif el.name == "select":
            ftype = "select"
        elif el_type == "file":
            ftype = "file"
        elif el_type == "checkbox":
            ftype = "checkbox"
        else:
            ftype = FIELD_TYPE_MAP.get(el_type, "text")

        options = None
        if el.name == "select":
            options = [
                o.get_text(strip=True) for o in el.find_all("option")
                if not o.has_attr("disabled") and o.get_text(strip=True)
            ]

        fields.append({
            "name": name.rstrip("[]"),
            "label": label_text,
            "type": ftype,
            "is_required": el.has_attr("required"),
            "options": options,
            "sort_order": order,
        })
    # de-dup by name, keep first occurrence
    seen = set()
    deduped = []
    for f in fields:
        if f["name"] in seen:
            continue
        seen.add(f["name"])
        deduped.append(f)
    return deduped


def main():
    # Pull header/footer specifically from contact.html -- confirmed to
    # have the real site-wide header/footer (some pages, e.g. index.html,
    # contain unrelated <footer> tags inside modal/dialog components).
    chrome_source = ROOT / "contact.html"
    chrome_soup = BeautifulSoup(chrome_source.read_text(encoding="utf-8", errors="ignore"), "lxml")
    header_html = str(chrome_soup.find("header"))
    footer_tags = chrome_soup.find_all("footer")
    footer_html = str(max(footer_tags, key=lambda t: len(str(t))))
    mobile_header = chrome_soup.find("div", class_="gbase-header-mobile")
    mobile_drawer = chrome_soup.find("div", class_="gbase-mobile-drawer")
    mobile_nav_html = (str(mobile_header) if mobile_header else "") + (str(mobile_drawer) if mobile_drawer else "")

    pages_out = []

    for rel_path in PAGES:
        file_path = ROOT / rel_path
        if not file_path.exists():
            print(f"MISSING: {rel_path}")
            continue

        html = file_path.read_text(encoding="utf-8", errors="ignore")
        soup = BeautifulSoup(html, "lxml")

        title_tag = soup.find("title")
        title = title_tag.get_text(strip=True) if title_tag else rel_path
        meta_desc_tag = soup.find("meta", attrs={"name": "description"})
        meta_desc = meta_desc_tag.get("content", "").strip() if meta_desc_tag else None

        header_tag = soup.find("header")
        footer_tags = soup.find_all("footer")
        # Largest <footer> is the real site-wide one; smaller ones are
        # decoys inside modal/dialog components (seen on index.html).
        footer_tag = max(footer_tags, key=lambda t: len(str(t))) if footer_tags else None
        form_tag = soup.find("form", class_="gbase-contact-form")

        # The contact-form-area wrapper often contains real unique content
        # around the form itself (a per-page heading, an "About Us" /
        # services blurb, etc.) -- not just the form. Capture that
        # wrapper's HTML and split it around the <form> so nothing inside
        # it is silently dropped; the form's own markup becomes the
        # rendered <x-dynamic-form> component instead.
        contact_before_html = ""
        contact_after_html = ""
        contact_area_tag = soup.find(class_="contact-form-area")
        if contact_area_tag and form_tag:
            wrapper_html = str(contact_area_tag)
            form_html = str(form_tag)
            if form_html in wrapper_html:
                before, after = wrapper_html.split(form_html, 1)
                contact_before_html = before
                contact_after_html = after

        # Body = everything between </header> and the contact-form-area
        # wrapper (or footer if no form on this page), preserved verbatim.
        body_html = ""
        if header_tag:
            body_nodes = []
            node = header_tag.next_sibling
            stop_classes = {"contact-form-area"}
            skip_classes = {"gbase-header-mobile", "gbase-mobile-drawer"}
            while node is not None:
                if node is footer_tag:
                    break
                node_classes = set(node.get("class")) if getattr(node, "get", None) and node.get("class") else set()
                if stop_classes & node_classes:
                    break
                if skip_classes & node_classes:
                    node = node.next_sibling
                    continue
                if getattr(node, "name", None) == "script":
                    node = node.next_sibling
                    continue
                body_nodes.append(str(node))
                node = node.next_sibling
            body_html = "".join(body_nodes).strip()

        # Page-specific inline <script> blocks (no src attribute) placed
        # after </footer> -- e.g. the used-equipments.html Google Sheet
        # loader. Vendor <script src="..."> tags are loaded once by the
        # shared layout instead of being duplicated per page.
        inline_scripts = []
        if footer_tag:
            node = footer_tag.next_sibling
            while node is not None:
                if getattr(node, "name", None) == "script" and not node.get("src"):
                    inline_scripts.append(str(node))
                node = node.next_sibling
        extra_scripts_html = "\n".join(inline_scripts)

        slug = rel_path[:-5]  # strip ".html"
        if slug == "index":
            slug = "home"

        page_source_value = rel_path  # matches existing hidden page_source input value

        fields = extract_form_fields(form_tag)

        pages_out.append({
            "slug": slug,
            "title": title,
            "meta_description": meta_desc,
            "body_html": body_html,
            "contact_before_html": contact_before_html,
            "contact_after_html": contact_after_html,
            "extra_scripts_html": extra_scripts_html,
            "page_source": page_source_value,
            "form_fields": fields,
            "has_form": form_tag is not None,
        })
        print(f"OK: {rel_path} -> slug={slug}, title={title!r}, fields={len(fields)}, body_len={len(body_html)}")

    (OUT_DIR / "header.html").write_text(rewrite_internal_links(header_html or ""), encoding="utf-8")
    (OUT_DIR / "footer.html").write_text(rewrite_internal_links(footer_html or ""), encoding="utf-8")
    (OUT_DIR / "mobile_nav.html").write_text(rewrite_internal_links(mobile_nav_html or ""), encoding="utf-8")
    for p in pages_out:
        p["body_html"] = rewrite_internal_links(p["body_html"])
        p["contact_before_html"] = rewrite_internal_links(p["contact_before_html"])
        p["contact_after_html"] = rewrite_internal_links(p["contact_after_html"])
    (OUT_DIR / "pages.json").write_text(json.dumps(pages_out, indent=2), encoding="utf-8")
    print(f"\nWrote {len(pages_out)} pages to {OUT_DIR}/pages.json")


if __name__ == "__main__":
    main()
