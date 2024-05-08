<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;
use Illuminate\Database\Eloquent\Model;

class RelationCheckboxColumn extends Column
{
    protected string $view = 'tables.columns.relation-checkbox-column';


    protected string $relationName;

    // public function __construct(string $relationName)
    // {
    //     parent::__construct($relationName);

    //     $this->relationName = $relationName;
    // }

    public function cState(): bool
    {
      


      //  dd($this->relationName);
        // Implement logic to determine checkbox state based on relation
        // Example: Check if the related record exists
        //return $record->{$this->relationName}()->exists();
        return true;
    }








}
