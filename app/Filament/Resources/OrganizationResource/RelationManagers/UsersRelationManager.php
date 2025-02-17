<?php

namespace App\Filament\Resources\OrganizationResource\RelationManagers;

use App\Models\Organization;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                // Tables\Actions\AttachAction::make(),               
                AttachAction::make()
                    ->label('Add Staff')
                    ->form(function (Form $form) {
                        return $form
                            ->schema([
                                Select::make('recordId')
                                    ->label('Assign Staff User')
                                    ->options(function () {
                                        $organizationId = $this->getOwnerRecord()->id; 
                                        return User::where('type', 'staff') 
                                            ->whereNotIn('id', Organization::find($organizationId)->users->pluck('id'))
                                            ->orderBy('name') 
                                            ->pluck('name', 'id'); 
                                    })
                                    ->searchable()
                                    ->preload() 
                                    ->required(),
                            ]);
                    })
                    ->recordSelectOptionsQuery(function ($query) {
                        return $query->where('type', 'staff'); 
                    })
                
               
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
