<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Category;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Nette\Utils\ImageColor;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $slug = 'projects';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->createOptionForm([
                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->readOnly()
                            ->required()
                            ->unique(Category::class, 'slug', fn($record) => $record),

                        Select::make('type')
                            ->options([
                                Category::TYPE_POST => 'Post',
                                Category::TYPE_SERVICE => 'Service',
                            ])
                            ->required()
                    ])
                    ->required()
                    ->relationship('category', 'title'),

                TextInput::make('title')
                    ->required()
                    ->debounce(500)
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->readOnly()
                    ->required()
                    ->unique(Project::class, 'slug', fn($record) => $record),

                TextInput::make('description')
                    ->required(),

                Select::make('location')
                    ->options([
                        'amed' => 'Amed',
                        'bangli' => 'Bangli',
                        'candidasa' => 'Candidasa',
                        'canggu' => 'Canggu',
                        'denpasar_barat' => 'Denpasar Barat',
                        'denpasar_selatan' => 'Denpasar Selatan',
                        'denpasar_timur' => 'Denpasar Timur',
                        'denpasar_utara' => 'Denpasar Utara',
                        'gianyar' => 'Gianyar',
                        'gilimanuk' => 'Gilimanuk',
                        'jimbaran' => 'Jimbaran',
                        'karangasem' => 'Karangasem',
                        'kuta' => 'Kuta',
                        'kuta_selatan' => 'Kuta Selatan',
                        'kuta_utara' => 'Kuta Utara',
                        'legian' => 'Legian',
                        'lovina' => 'Lovina',
                        'negara' => 'Negara',
                        'nusa_dua' => 'Nusa Dua',
                        'pemuteran' => 'Pemuteran',
                        'sanur' => 'Sanur',
                        'seminyak' => 'Seminyak',
                        'seririt' => 'Seririt',
                        'singaraja' => 'Singaraja',
                        'tabanan' => 'Tabanan',
                        'tejakula' => 'Tejakula',
                        'ubud' => 'Ubud',
                    ])
                    ->required(),

                DatePicker::make('start_date')
                    ->required(),

                DatePicker::make('end_date')
                    ->required(),

                TextInput::make('client_name')
                    ->required()
                    ->label('Client Name'),

                Select::make('status')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'pending' => 'Pending',
                        'on_hold' => 'On Hold',
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'in_progress' => 'In Progress',
                    ])
                    ->required(),

                DateTimePicker::make('completion')
                    ->required()
                    ->date()
                    ->time()
                    ->minDate(now()->addDays(1))
                    ->label('Completion Date'),

                Select::make('architect_name')
                    ->required()
                    ->label('Architect Name')
                    ->options([
                        'ahmad' => 'Ahmad',
                        'wahyu' => 'Wahyu',
                    ]),

                Select::make('project_type')
                    ->required()
                    ->options([
                        'residential' => 'Residential',
                        'commercial' => 'Commercial',
                        'industrial' => 'Industrial',
                        'land' => 'Land',
                        'office' => 'Office',
                        'other' => 'Other',
                    ]),

                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->required(),

                TextInput::make('budget')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->required(),

                Toggle::make('featured')
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Project $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Project $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description'),

                TextColumn::make('client_name'),

                TextColumn::make('location'),

                ImageColumn::make('image')
                    ->circular(),

                TextColumn::make('start_date')
                    ->date(),

                TextColumn::make('end_date')
                    ->date(),

                TextColumn::make('status'),

                TextColumn::make('featured'),
            ])
            ->filters([
        //
    ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug'];
    }
}
