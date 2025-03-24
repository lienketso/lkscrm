<?php

if (!function_exists('bouncer')) {
    function bouncer()
    {
        return app()->make('bouncer');
    }
}

if (!function_exists('daysDifference')) {
    function daysDifference($date): array
    {
        // Chuyển đổi ngày đầu vào thành đối tượng DateTime
        $inputDate = new DateTime($date);
        $currentDate = new DateTime(); // Ngày hiện tại
        $currentDate->setTime(0, 0);   // Đặt giờ về 00:00:00 để tránh sai lệch thời gian

        // Tính số ngày chênh lệch (có thể là số âm nếu ngày đã qua)
        $diffDays = (int)$currentDate->diff($inputDate)->format('%r%a');

        // Kiểm tra ngày quá khứ hay tương lai
        if ($diffDays > 0) {
            return [
                'css_class' => 'label-active',
                'txt' => "Còn lại {$diffDays} ngày"
            ];
        } elseif ($diffDays < 0) {
            return [
                'css_class' => 'label-inactive',
                'txt' => "Đã quá " . abs($diffDays) . " ngày"
            ];
        } else {
            return [
                'css_class' => 'label-warning',
                'txt' => "Còn lại {$diffDays} ngày"
            ];
        }
    }
}
