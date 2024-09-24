<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents'; // Specify the table name if different from the model name

    protected $primaryKey = 'document_id'; // Specify the primary key

    // Fillable attributes
    protected $fillable = [
        'student_id',
        'document_type',
        'document_url',
        'uploaded_on',
    ];

    // Define relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
