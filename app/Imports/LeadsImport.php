<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Webkul\Contact\Models\Person;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\Lead\Models\Lead;
use Webkul\Lead\Repositories\LeadRepository;

class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            $title = $row['title'] ?? null;
            $name = $row['name'] ?? null;
            $email = $row['emails'] ?? null;
            $contactNumbers = $row['contact_numbers'] ?? null;
            $leadPipelineId = $row['lead_pipeline_id'] ?? null;
            $leadSourceId = $row['lead_source_id'] ?? null;
            $leadTypeId = $row['lead_type_id'] ?? null;

            // Bỏ qua dòng nếu thiếu thông tin quan trọng
            if (!$email || !$title) {
                Log::warning('Dòng bị bỏ qua do thiếu email hoặc title', $row);
                return null;
            }

            // Tìm Person theo email
            $person = Person::where('emails', 'like', '%"value":"' . $email . '"%')->first();

            if (!$person) {
                $person = Person::create([
                    'name' => $name,
                    'emails' => [
                        ['value' => $email, 'label' => 'work']
                    ],
                    'contact_numbers' => [
                        ['value' => $contactNumbers, 'label' => 'work']
                    ]
                ]);
            }

            // Kiểm tra lead đã tồn tại
            $existingLead = Lead::where([
                ['title', '=', $title],
                ['person_id', '=', $person->id]
            ])->first();

            if (!$existingLead) {
                return new Lead([
                    'title' => $title,
                    'person_id' => $person->id,
                    'lead_pipeline_id' => $leadPipelineId,
                    'lead_source_id' => $leadSourceId,
                    'lead_type_id' => $leadTypeId,
                    'is_customer'=>0,
                    'status'=>1,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi import dòng: ' . $e->getMessage(), [
                'row' => $row,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }

        return null;
    }
}
