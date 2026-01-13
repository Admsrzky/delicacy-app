<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    // Mengganti icon dengan yang lebih relevan untuk makanan/resep
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    // Memberikan label navigasi yang lebih ramah
    protected static ?string $navigationLabel = 'Manajemen Resep';

    // Menambahkan group navigasi agar sidebar lebih rapi
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Masukan detail dasar resep Anda di sini.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Resep')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Ayam Bakar Madu'),

                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([ // Memungkinkan tambah kategori langsung dari form resep
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Foto Resep')
                            ->image()
                            ->directory('recipes')
                            ->required()
                            ->imageEditor() // Menambahkan fitur crop/edit gambar
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Masak')
                    ->schema([
                        Forms\Components\TextInput::make('cooking_time')
                            ->label('Waktu Masak')
                            ->numeric()
                            ->suffix(' Menit')
                            ->required(),

                        Forms\Components\Select::make('difficulty')
                            ->label('Tingkat Kesulitan')
                            ->options([
                                'Mudah' => 'Mudah',
                                'Menengah' => 'Menengah',
                                'Sulit' => 'Sulit',
                            ])->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampilkan sebagai Unggulan')
                            ->helperText('Resep ini akan muncul di bagian utama/Hero.')
                            ->onColor('success'),
                    ])->columns(3),

                Forms\Components\Section::make('Konten Resep')
                    ->schema([
                        Forms\Components\Repeater::make('ingredients')
                            ->label('Daftar Bahan-Bahan')
                            ->schema([
                                Forms\Components\TextInput::make('item')
                                    ->required()
                                    ->placeholder('Contoh: 500g Dada Ayam'),
                            ])
                            ->grid(2)
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Bahan'),

                        Forms\Components\Repeater::make('steps')
                            ->label('Langkah-Langkah Pembuatan')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Nama Langkah')
                                    ->required()
                                    ->placeholder('Contoh: Persiapan Bumbu'),
                                Forms\Components\Textarea::make('desc')
                                    ->label('Deskripsi Detail')
                                    ->required()
                                    ->rows(3),
                            ])
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Langkah')
                            ->collapsible(), // Bisa di-collapse agar form tidak terlalu panjang
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Resep')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('difficulty')
                    ->label('Kesulitan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mudah' => 'success',
                        'Menengah' => 'warning',
                        'Sulit' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('cooking_time')
                    ->label('Waktu')
                    ->suffix(' Menit')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Unggulan')
                    ->alignCenter()
                    ->onColor('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc') // Resep terbaru muncul paling atas
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Kategori'),

                Tables\Filters\SelectFilter::make('difficulty')
                    ->options([
                        'Mudah' => 'Mudah',
                        'Menengah' => 'Menengah',
                        'Sulit' => 'Sulit',
                    ])
                    ->label('Kesulitan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada resep')
            ->emptyStateDescription('Mulai bagikan cita rasa Anda dengan menambahkan resep pertama.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
