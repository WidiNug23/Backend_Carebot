<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KalkulatorGiziModel;

class KalkulatorGiziController extends Controller
{
    private function setCORSHeaders()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }

    public function index()
    {
        $this->setCORSHeaders(); // Set CORS headers
        $model = new KalkulatorGiziModel();
        $data = $model->findAll(); // Get all data from 'kebutuhan_gizi'
        
        return $this->response->setJSON($data);
    }

    public function calculate()
    {
        $this->setCORSHeaders(); // Set CORS headers
    
        if ($this->request->getMethod() === 'options') {
            return $this->response->setStatusCode(200); // Return 200 OK for OPTIONS request
        }
    
        // Get input data from POST
        $inputData = $this->request->getJSON();
    
        // Validate input data
        if (!$inputData) {
            return $this->response->setJSON(['error' => 'Invalid input']);
        }
    
        $gender = $inputData->gender;
        $weight = $inputData->weight;  // in kg
        $height = $inputData->height;  // in cm
        $age = $inputData->age;        // in years
        $activityLevel = $inputData->activity_level;
        $ibuId = $inputData->ibu_id;   // Retrieve ibu_id from the request payload
    
        // Calculate BMR (Basal Metabolic Rate)
        if ($gender == "male") {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }
        
    
        // Adjust BMR based on activity level
        switch ($activityLevel) {
            case "sedentary":
                $tdee = $bmr * 1.2;
                break;
            case "light":
                $tdee = $bmr * 1.375;
                break;
            case "moderate":
                $tdee = $bmr * 1.55;
                break;
            case "active":
                $tdee = $bmr * 1.725;
                break;
            default:
                return $this->response->setJSON(['error' => 'Invalid activity level']);
        }
    
        // Calculate macronutrients
        $carbs = ($tdee * 0.55) / 4; // 50% of TDEE for carbs
        $protein = ($tdee * 0.15) / 4; // 25% of TDEE for protein
        $fat = ($tdee * 0.30) / 9; // 25% of TDEE for fat
    
        // Save data to the database including ibu_id
        $model = new KalkulatorGiziModel();
        $model->save([
            'gender' => $gender,
            'weight' => $weight,
            'height' => $height,
            'age' => $age,
            'activity_level' => $activityLevel,
            'tdee' => round($tdee, 2),
            'carbs' => round($carbs, 2),
            'protein' => round($protein, 2),
            'fat' => round($fat, 2),
            'ibu_id' => $ibuId // Include ibu_id here
        ]);
    
        // Fetch all the nutritional data from the database
        $nutrisiData = $model->findAll(); // Fetch all entries in the database
    
        // Return the results and all stored data in JSON format
        return $this->response->setJSON([
            'tdee' => round($tdee, 2),
            'carbs' => round($carbs, 2),
            'protein' => round($protein, 2),
            'fat' => round($fat, 2),
            'nutrisi_data' => $nutrisiData // Return the fetched data
        ]);
    }

    public function getKalkulatorData($ibu_id)
    {
        $model = new KalkulatorGiziModel();
        
        // Fetch the nutrition data for a specific ibu_id
        $kalkulatorData = $model->where('ibu_id', $ibu_id)->findAll();

        // Check if no data is found for the given ibu_id
        if (empty($kalkulatorData)) {
            return $this->failNotFound('Kalkulator data not found');
        }

        // Return the data in a JSON response
        return $this->respond($kalkulatorData);
    }
}
