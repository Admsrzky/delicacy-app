<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipResource\Pages;
use App\Models\Tip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TipResource extends Resource
{
    protected static ?string $model = Tip::class;

    // Menggunakan ikon lampu yang lebih modern
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationLabel = 'Tips & Trik';

    // Menyatukan ke dalam grup Manajemen Konten
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Berbagi Pengetahuan Kuliner')
                    ->description('Tuliskan tips praktis untuk membantu komunitas memasak lebih baik.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Tips')
                            ->required()
                            ->placeholder('Contoh: Rahasia Sambal Awet Tanpa Pengawet')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Ilustrasi')
                            ->image()
                            ->directory('tips')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->required(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Detail Tips')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'bulletList', 'orderedList', 'link', 'redo', 'undo', 'h2', 'h3'
                            ]),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->square() // Menggunakan square/rounded agar terlihat seperti thumbnail artikel
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->description(fn (Tip $record): string => Str::limit(strip_tags($record->content), 50)),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-m-tag'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terbit Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada tips')
            ->emptyStateDescription('Tulis tips dapur pertama Anda untuk menginspirasi orang lain.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTips::route('/'),
            'create' => Pages\CreateTip::route('/create'),
            'edit' => Pages\EditTip::route('/{record}/edit'),
        ];
    }
}
