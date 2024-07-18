<?

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TampilPangan extends Model
{
    use HasFactory;

    protected $table = 'tampil_pangan'; // Ensure this matches your table name

    public function pangan()
    {
        return $this->belongsTo(Pangan::class, 'id_pangan');
    }

    public function operation_pangan()
    {
        return $this->belongsTo(TambahPangan::class, 'id_operation_pangan');
    }
}
