<?php
namespace App\Interfaces\Client;

use App\Interfaces\Interfaces\ICrudRepository;
/**
 *
 */
interface MedicationRepositoryInterface extends ICrudRepository
{
    public function getTodayMedications($userId, $today);

    public function findById($id, $userId);
}
