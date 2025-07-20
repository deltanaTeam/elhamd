<?php
namespace App\Repositories\Client;
use App\Models\Medication;
use App\Models\MedicationDay;
use App\Models\MedicationTime;
use App\Interfaces\Client\MedicationRepositoryInterface;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;



class MedicationRepository extends CrudRepository implements MedicationRepositoryInterface
{

  protected Model $model;

  public function __construct(Medication $model)
  {
      $this->model = $model;
  }

    // public function create(array $data)
    // {
    //     return Medication::create($data);
    // }

      public function getTodayMedications($userId, $today)
    {
        return Medication::with('times')
            ->where('user_id', $userId)
            ->where('is_expired', false)
            ->whereHas('days', function ($query) use ($today) {
                $query->where('day_of_week', $today);
            })
            ->get();
    }



 public function findById($id, $userId)
    {
        return Medication::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
    }


}
