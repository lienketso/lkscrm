<?php

namespace Webkul\Admin\Listeners;

use Webkul\Admin\Services\ZaloService;
use Webkul\Lead\Models\ZaloTemplate;
use Webkul\Lead\Models\ZaloTemplateInfo;

class Zalo
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * @param
     * @return void
     */
    public function syncTemplate()
    {
        $service = new ZaloService();
        $data = $service->getTemplate();
        foreach ($data as $item) {
            
            $checkIsset = ZaloTemplate::whereTemplateId($item->templateId)->first();
            if (empty($checkIsset)) {
                $tmpTemplateInfo = $service->getTemplateInfo($item->templateId);

                $modelTemplate = new ZaloTemplate();
                $modelTemplate->template_id = $item->templateId;
                $modelTemplate->template_name = $item->templateName;
                $modelTemplate->created_time = $item->createdTime;
                $modelTemplate->status = ZaloTemplate::STATUS[$item->status];
                $modelTemplate->template_quality = ZaloTemplate::QUALITY[$item->templateQuality];
                $modelTemplate->price = $tmpTemplateInfo->price;
                $modelTemplate->timeout = $tmpTemplateInfo->timeout;
                $modelTemplate->save();

                $tmpParams = $tmpTemplateInfo->listParams;
                
                foreach ($tmpParams as $param) {
                    $modelTemplateInfo = new ZaloTemplateInfo();
                    $modelTemplateInfo->template_id = $item->templateId;
                    $modelTemplateInfo->name = $param->name;
                    $modelTemplateInfo->require = $param->require;
                    $modelTemplateInfo->type = $param->type;
                    $modelTemplateInfo->max_length = $param->maxLength;
                    $modelTemplateInfo->min_length = $param->minLength;
                    $modelTemplateInfo->accept_null = $param->acceptNull;
                    $modelTemplateInfo->save();
                }
            }
        }
    }
}
