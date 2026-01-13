<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\FontWeight;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    // Mengganti icon navigasi menjadi chat/komentar
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Komentar')
                    ->description('Tinjau isi komentar dan berikan moderasi jika diperlukan.')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled(), // Biasanya admin tidak mengubah siapa yang berkomentar
                        Forms\Components\Select::make('recipe_id')
                            ->relationship('recipe', 'title')
                            ->disabled(),
                        Forms\Components\Select::make('rating')
                            ->options([
                                1 => '1 Bintang',
                                2 => '2 Bintang',
                                3 => '3 Bintang',
                                4 => '4 Bintang',
                                5 => '5 Bintang',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('comment')
                            ->label('Isi Komentar')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Tampilkan di Website')
                            ->helperText('Jika dinonaktifkan, komentar tidak akan terlihat oleh publik.')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('user.profile_photo_path') // Sesuaikan dengan nama kolom foto di tabel users
                ->circular()
                ->defaultImageUrl(function ($record) {
                    // Jika foto kosong, ambil inisial dari nama user via API UI-Avatars
                    return 'https://ui-avatars.com/api/?name=' . urlencode($record->user->name) . '&color=FFFFFF&background=ea580c';
                }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('recipe.title')
                    ->label('Resep')
                    ->icon('heroicon-m-book-open') // Menambahkan icon buku resep
                    ->color('primary')
                    ->limit(25)
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->alignCenter()
                    ->badge() // Menggunakan badge agar lebih menarik
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default => 'danger',
                    })
                    ->icon('heroicon-m-star'),

                Tables\Columns\TextColumn::make('comment')
                    ->label('Isi Komentar')
                    ->limit(40)
                    ->tooltip(fn (Comment $record): string => $record->comment) // Menampilkan tooltip teks lengkap
                    ->wrap(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Status')
                    ->onIcon('heroicon-m-eye')
                    ->offIcon('heroicon-m-eye-slash')
                    ->onColor('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Kirim')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->color('gray')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall),
            ])
            ->defaultSort('created_at', 'desc') // Menampilkan komentar terbaru di atas
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Visibilitas')
                    ->placeholder('Semua Komentar')
                    ->trueLabel('Hanya yang Tampil')
                    ->falseLabel('Hanya yang Disembunyikan')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_visible', true),
                        false: fn (Builder $query) => $query->where('is_visible', false),
                    ),
                Tables\Filters\SelectFilter::make('rating')
                    ->options([
                        5 => '5 Bintang',
                        4 => '4 Bintang',
                        3 => '3 Bintang',
                        2 => '2 Bintang',
                        1 => '1 Bintang',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(), // Mengubah tombol edit menjadi icon saja agar rapi
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
