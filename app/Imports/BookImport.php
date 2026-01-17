<?php

namespace App\Imports;
use App\BookBulkTemporary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new BookBulkTemporary([
          "book_title" => @$row['book_title'],
          "book_category_id" => @$row['book_category_id'],
          "book_subject_id" => @$row['book_subject_id'],
          "book_number" =>  @$row['book_number'],
          "isbn_no" =>  @$row['isbn_no'],
          "publisher_name" =>  @$row['publisher_name'],
          "author_name" =>  @$row['author_name'],
          "rack_number" =>   @$row['rack_number'],
          "quantity" => @$row['quantity'],
          "book_price" => @$row['book_price'],
          "details" =>  @$row['details'],
          "user_id" => Auth::user()->id
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}