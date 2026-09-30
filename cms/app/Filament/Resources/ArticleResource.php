<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Articles';

    protected static ?string $navigationGroup = 'Knowledge Centre';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Textarea::make('excerpt')->label('Short Excerpt (shown on the listing card)')->rows(2)->required(),
            RichEditor::make('body')->label('Full Article')->columnSpanFull(),
            FileUpload::make('featured_image')
                ->label('Featured Image')
                ->image()
                ->disk('public')
                ->directory('articles')
                ->imagePreviewHeight('150'),
            TagsInput::make('tags')->label('Tags')->placeholder('Add a tag and press enter'),
            TextInput::make('author_name')->label('Author')->default('GBASE Team'),
            DateTimePicker::make('published_at')->label('Published At'),
            Toggle::make('is_published')->label('Published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')->label('')->disk('public'),
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('author_name')->label('Author'),
                TextColumn::make('published_at')->dateTime('M j, Y')->label('Published'),
                IconColumn::make('is_published')->label('Published')->boolean(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([
                EditAction::make(),
                Action::make('viewArticle')
                    ->label('View')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (Article $record): string => route('articles.show', $record->slug))
                    ->openUrlInNewTab(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
