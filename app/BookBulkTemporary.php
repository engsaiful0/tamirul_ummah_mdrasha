<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookBulkTemporary extends Model
{
    protected $fillable  = ['book_title', 'book_category_id','book_subject_id','book_number','isbn_no','publisher_name','author_name','rack_number','quantity','book_price','details','user_id'];
}