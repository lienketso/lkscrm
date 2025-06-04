<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\Lead\Repositories\LeadRepository;

class LeadsImport implements ToModel
{
    private $rowCount = 0;
    protected $personRepository;
    protected $leadRepository;
    
    public function model(array $row)
    {
        // Tăng số dòng đã được đọc
        $this->rowCount++;

        // Kiểm tra xem dòng đó có phải là dòng đầu tiên không
        if ($this->rowCount === 1) {
            // Nếu là dòng đầu tiên, trả về null để bỏ qua
            return null;
        }

        $title = $row[0] ?? null; // Cột A
        $name = $row[1] ?? null;  // Cột B
        $email = $row[2] ?? null; // Cột C
        $contactNumbers = $row[3] ?? null; // Cột D
        $leadPipelineId = $row[4] ?? null; // Cột E

        // Check if person exists with this email
        $person = $this->personRepository->findOneWhere([
            ['emails', 'like', '%"value":"' . $email . '"%']
        ]);

        if (!$person) {
            // Create new person
            $person = $this->personRepository->create([
                'name' => $name,
                'emails' => json_encode([
                    [
                        'value' => $email,
                        'label' => 'work'
                    ]
                ]),
                'contact_numbers' => json_encode([
                    [
                        'value' => $contactNumbers,
                        'label' => 'work'
                    ]
                ])
            ]);
        }
        // Check if lead exists
        $existingLead = $this->leadRepository->findOneWhere([
            'title' => $title,
            'person_id' => $person->id
        ]);

        if (!$existingLead) {
            // Create new lead
            return $this->leadRepository->create([
                'title' => $title,
                'person_id' => $person->id,
                'lead_pipeline_id' => $leadPipelineId
            ]);
        }

        return null;
    }

}