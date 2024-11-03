<?php

namespace Webkul\Core\Console\Commands;

use Illuminate\Console\Command;
use Webkul\Lead\Models\TmpCustomer as ModelTmpCustomer;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\User\Repositories\UserRepository;
use Webkul\Lead\Repositories\LeadRepository;
use Webkul\User\Models\User;
use Webkul\Admin\Services\KiotVietService;

class TmpCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp-customers {option}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test insert tmp customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected PersonRepository $personRepository,
        protected UserRepository $userRepository,
        protected LeadRepository $leadRepository,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # set default user vì hệ thống này có phần log activity nên bắt buộc phải có auth(), chưa tìm cách tắt đc log khi chạy command
        $user = User::where('email', 'thanhan1507@gmail.com')->first();
        auth()->login($user);
        $userId = $user->id;

        $option = $this->argument('option') ?: 1;
        if ($option == 1) {

            $serviceKiotViet = new KiotVietService(); 
            $page = 1;
            $size = 100;
            while (true) {
                $data = $serviceKiotViet->getCustomerFromKiotViet($page, $size);
                if ($data->data && count($data->data) > 0) {
                    foreach ($data->data as $k => $item) {
                        $model = new ModelTmpCustomer();
                        $model->id_kiotviet = $item->id;
                        $model->code = $item->code;
                        $model->name = $item->name;
                        $model->contactNumber = $item->contactNumber ?? '';
                        $model->address = $item->address ?? '';
                        $model->branchId = $item->branchId;
                        $model->locationName = $item->locationName ?? '';
                        $model->wardName = $item->wardName ?? '';
                        $model->type = $item->type ?? '';
                        $model->organization = $item->organization ?? '';
                        $model->totalInvoiced = $item->totalInvoiced ?? '';
                        $model->totalPoint = $item->totalPoint ?? '';
                        $model->save();
                        echo $page . ' - ' . $k . ': done->' . $item->name . "; \n";
                    }
                } else {
                    break;
                }
                $page++;
            }

            echo "done: $page \n";
        }
        if ($option == 2) {
            # convert sang bảng leads tương ứng với is_customer = true (khách hàng hiện hữu)
            # thông tin về source mạc định PKC1  có id là 7 và PKC2 có id là 8: đây là 2 id trong db, còn dưới json là thông tin chi nhánh trả về từ kiotviet
            // {
            //     "id": 57644,
            //     "branchName": "PKC 1",
            //     "address": "102 An Đào B",
            //     "locationName": "Hà Nội - Huyện Gia Lâm",
            //     "wardName": "Thị trấn Trâu Quỳ",
            //     "contactNumber": "+84962170884",
            //     "retailerId": 696740,
            //     "modifiedDate": "2024-10-22T10:54:46.9570000",
            //     "createdDate": "2020-06-06T11:43:02.2130000"
            // },
            // {
            //     "id": 305912,
            //     "branchName": "PKC 2",
            //     "address": "S1SH15A Sky Oasis, Ecopark. Văn Giang,Hưng Yên",
            //     "locationName": "Hưng Yên - Huyện Văn Giang",
            //     "wardName": "Xã Phụng Công",
            //     "contactNumber": "0382800822",
            //     "retailerId": 696740,
            //     "modifiedDate": "2024-09-08T12:06:12.8930000",
            //     "createdDate": "2022-12-08T17:02:55.1630000"
            // }
            $sources = [
                '57644' => 7,
                '305912' => 8,
            ];
            
            // $data = ModelTmpCustomer::groupby('code')->offset(0)->limit(100000)->get();
            $data = ModelTmpCustomer::groupby('code')->get();
            // dd(count($data));
            foreach ($data as $item) {
                $params = [
                    'title' => $item->name,
                    'lead_value' => $item->totalRevenue,
                    'lead_source_id' => $sources[$item->branchId],
                    'lead_type_id' => 2,
                    'person' => [
                        'id' => null,
                        'name' => $item->name,
                        'emails' => [
                            [
                                'value' => $item->id_kiotviet . '@gmail.com',
                                'label' => 'work'
                            ]
                        ],
                        'contact_numbers' => [
                            [
                                'value' => $item->contactNumber,
                                'label' => 'work'
                            ]
                        ]
                    ],
                    'entity_type' => 'leads',
                    'status' => 1,
                    'is_customer' => 1,
                    'id_kiotviet' => $item->id_kiotviet,
                    'code' => $item->code,
                    'address' => $item->address,
                ];
                $customer = $this->leadRepository->create($params);
                echo 'done->' . $item->name . "; \n";
            }
            exit("done 2! \n");
        }

        exit("done 333! \n");
    }
}
