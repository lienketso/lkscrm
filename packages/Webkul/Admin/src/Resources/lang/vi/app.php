<?php

return [
    'an_error_occurred' => 'Có lỗi xảy ra, vui lòng thử lại sau',
    'acl' => [
        'leads'           => 'Khách hàng tiềm năng',
        'lead'            => 'Khách hàng tiềm năng',
        'customers'       => 'Khách hàng hiện hữu',
        'customer'        => 'Khách hàng hiện hữu',
        'quotes'          => 'Báo giá',
        'mail'            => 'Thư',
        'inbox'           => 'Hộp thư đến',
        'draft'           => 'Bản nháp',
        'outbox'          => 'Hộp thư đi',
        'sent'            => 'Đã gửi',
        'trash'           => 'Thùng rác',
        'activities'      => 'Các hoạt động',
        'webhook'         => 'Webhook',
        'contacts'        => 'Liên hệ',
        'persons'         => 'Người',
        'organizations'   => 'Tổ chức',
        'products'        => 'Sản phẩm',
        'settings'        => 'Cài đặt',
        'groups'          => 'Nhóm',
        'roles'           => 'Vai trò',
        'users'           => 'Người dùng',
        'user'            => 'Người dùng',
        'automation'      => 'Tự động hóa',
        'attributes'      => 'Thuộc tính',
        'pipelines'       => 'Quy trình',
        'sources'         => 'Nguồn',
        'types'           => 'Loại',
        'email-templates' => 'Mẫu Email',
        'workflows'       => 'Quy trình công việc',
        'other-settings'  => 'Cài đặt khác',
        'tags'            => 'Thẻ',
        'configuration'   => 'Cấu hình',
        'create'          => 'Tạo',
        'edit'            => 'Chỉnh sửa',
        'view'            => 'Xem',
        'print'           => 'In',
        'delete'          => 'Xóa',
        'export'          => 'Xuất',
        'mass-delete'     => 'Xóa hàng loạt',
    ],

    'users' => [
        'activate-warning' => 'Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ với quản trị viên.',
        'login-error'      => 'Thông tin đăng nhập không khớp với hồ sơ của chúng tôi.',

        'login' => [
            'email'                => 'Địa chỉ Email',
            'forget-password-link' => 'Quên mật khẩu?',
            'password'             => 'Mật khẩu',
            'submit-btn'           => 'Đăng nhập',
            'title'                => 'Đăng nhập',
        ],

        'forget-password' => [
            'create' => [
                'email'           => 'Email đã đăng ký',
                'email-not-exist' => 'Email không tồn tại',
                'page-title'      => 'Quên mật khẩu',
                'reset-link-sent' => 'Đã gửi liên kết đặt lại mật khẩu',
                'sign-in-link'    => 'Quay lại trang đăng nhập?',
                'submit-btn'      => 'Đặt lại',
                'title'           => 'Khôi phục mật khẩu',
            ],
        ],

        'reset-password' => [
            'back-link-title'  => 'Quay lại trang đăng nhập?',
            'confirm-password' => 'Xác nhận mật khẩu',
            'email'            => 'Email đã đăng ký',
            'password'         => 'Mật khẩu',
            'submit-btn'       => 'Đặt lại mật khẩu',
            'title'            => 'Đặt lại mật khẩu',
        ],
    ],

    'account' => [
        'edit' => [
            'back-btn'          => 'Quay lại',
            'change-password'   => 'Đổi mật khẩu',
            'confirm-password'  => 'Xác nhận mật khẩu',
            'current-password'  => 'Mật khẩu hiện tại',
            'email'             => 'Email',
            'general'           => 'Chung',
            'invalid-password'  => 'Mật khẩu hiện tại không đúng.',
            'name'              => 'Tên',
            'password'          => 'Mật khẩu',
            'profile-image'     => 'Ảnh hồ sơ',
            'save-btn'          => 'Lưu tài khoản',
            'title'             => 'Tài khoản của tôi',
            'update-success'    => 'Cập nhật tài khoản thành công',
            'upload-image-info' => 'Tải lên ảnh hồ sơ (110px X 110px) dưới định dạng PNG hoặc JPG',
        ],
    ],

    'components' => [
        'activities' => [
            'actions' => [
                'mail' => [
                    'btn'          => 'Thư',
                    'title'        => 'Soạn thư',
                    'to'           => 'Tới',
                    'enter-emails' => 'Nhấn enter để thêm email',
                    'cc'           => 'CC',
                    'bcc'          => 'BCC',
                    'subject'      => 'Chủ đề',
                    'send-btn'     => 'Gửi',
                    'message'      => 'Tin nhắn',
                ],

                'file' => [
                    'btn'           => 'Tập tin',
                    'title'         => 'Thêm tập tin',
                    'title-control' => 'Tiêu đề',
                    'name'          => 'Tên',
                    'description'   => 'Mô tả',
                    'file'          => 'Tập tin',
                    'save-btn'      => 'Lưu tập tin',
                ],

                'note' => [
                    'btn'      => 'Ghi chú',
                    'title'    => 'Thêm ghi chú',
                    'comment'  => 'Bình luận',
                    'save-btn' => 'Lưu ghi chú',
                ],

                'activity' => [
                    'btn'           => 'Hoạt động',
                    'title'         => 'Thêm hoạt động',
                    'title-control' => 'Tiêu đề',
                    'description'   => 'Mô tả',
                    'schedule-from' => 'Lịch trình từ',
                    'schedule-to'   => 'Lịch trình đến',
                    'location'      => 'Địa điểm',
                    'call'          => 'Cuộc gọi',
                    'meeting'       => 'Cuộc họp',
                    'lunch'         => 'Bữa trưa',
                    'save-btn'      => 'Lưu hoạt động',

                    'participants' => [
                        'title'       => 'Người tham gia',
                        'placeholder' => 'Nhập để tìm kiếm người tham gia',
                        'users'       => 'Người dùng',
                        'persons'     => 'Người',
                        'no-results'  => 'Không tìm thấy kết quả...',
                    ],
                ],
            ],

            'index' => [
                'from'         => 'Từ',
                'to'           => 'Đến',
                'cc'           => 'CC',
                'bcc'          => 'BCC',
                'all'          => 'Tất cả',
                'planned'      => 'Đã lên kế hoạch',
                'calls'        => 'Cuộc gọi',
                'meetings'     => 'Cuộc họp',
                'lunches'      => 'Bữa trưa',
                'files'        => 'Tập tin',
                'quotes'       => 'Báo giá',
                'notes'        => 'Ghi chú',
                'emails'       => 'Thư điện tử',
                'change-log'   => 'Nhật ký thay đổi',
                'by-user'      => 'Bởi :user',
                'scheduled-on' => 'Lên lịch vào',
                'location'     => 'Địa điểm',
                'participants' => 'Người tham gia',
                'mark-as-done' => 'Đánh dấu hoàn thành',
                'delete'       => 'Xóa',
                'edit'         => 'Chỉnh sửa',
                'view'         => 'Xem',
                'unlink'       => 'Bỏ liên kết',
                'empty'        => 'Trống',

                'empty-placeholders' => [
                    'all' => [
                        'title'       => 'Không tìm thấy hoạt động nào',
                        'description' => 'Không tìm thấy hoạt động nào cho mục này. Bạn có thể thêm hoạt động bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'planned' => [
                        'title'       => 'Không tìm thấy hoạt động đã lên kế hoạch',
                        'description' => 'Không tìm thấy hoạt động đã lên kế hoạch cho mục này. Bạn có thể thêm hoạt động đã lên kế hoạch bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'notes' => [
                        'title'       => 'Không tìm thấy ghi chú nào',
                        'description' => 'Không tìm thấy ghi chú nào cho mục này. Bạn có thể thêm ghi chú bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'calls' => [
                        'title'       => 'Không tìm thấy cuộc gọi nào',
                        'description' => 'Không tìm thấy cuộc gọi nào cho mục này. Bạn có thể thêm cuộc gọi bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'meetings' => [
                        'title'       => 'Không tìm thấy cuộc họp nào',
                        'description' => 'Không tìm thấy cuộc họp nào cho mục này. Bạn có thể thêm cuộc họp bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'lunches' => [
                        'title'       => 'Không tìm thấy bữa trưa nào',
                        'description' => 'Không tìm thấy bữa trưa nào cho mục này. Bạn có thể thêm bữa trưa bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'files' => [
                        'title'       => 'Không tìm thấy tập tin nào',
                        'description' => 'Không tìm thấy tập tin nào cho mục này. Bạn có thể thêm tập tin bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'emails' => [
                        'title'       => 'Không tìm thấy email nào',
                        'description' => 'Không tìm thấy email nào cho mục này. Bạn có thể thêm email bằng cách nhấp vào nút ở bảng điều khiển bên trái.',
                    ],

                    'system' => [
                        'title'       => 'Không tìm thấy nhật ký thay đổi nào',
                        'description' => 'Không tìm thấy nhật ký thay đổi nào cho mục này.',
                    ],
                ],
            ],
        ],

        'media' => [
            'images' => [
                'add-image-btn'     => 'Thêm Hình Ảnh',
                'ai-add-image-btn'  => 'AI Phép Thuật',
                'allowed-types'     => 'png, jpeg, jpg',
                'not-allowed-error' => 'Chỉ cho phép các tệp hình ảnh (.jpeg, .jpg, .png, ..).',

                'placeholders' => [
                    'front'     => 'Trước',
                    'next'      => 'Tiếp theo',
                    'size'      => 'Kích thước',
                    'use-cases' => 'Trường hợp sử dụng',
                    'zoom'      => 'Thu phóng',
                ],
            ],

            'videos' => [
                'add-video-btn'     => 'Thêm Video',
                'allowed-types'     => 'mp4, webm, mkv',
                'not-allowed-error' => 'Chỉ cho phép các tệp video (.mp4, .mov, .ogg ..).',
            ],
        ],

        'datagrid' => [
            'index' => [
                'no-records-selected'              => 'Chưa có bản ghi nào được chọn.',
                'must-select-a-mass-action-option' => 'Bạn phải chọn một tùy chọn hành động hàng loạt.',
                'must-select-a-mass-action'        => 'Bạn phải chọn một hành động hàng loạt.',
            ],

            'toolbar' => [
                'length-of' => ':length của',
                'of'        => 'của',
                'per-page'  => 'Mỗi Trang',
                'results'   => ':total Kết quả',
                'delete'    => 'Xóa',
                'selected'  => ':total Mục đã chọn',

                'mass-actions' => [
                    'submit'        => 'Gửi',
                    'select-option' => 'Chọn Tùy Chọn',
                    'select-action' => 'Chọn Hành Động',
                ],

                'filter' => [
                    'apply-filters-btn' => 'Áp dụng Bộ lọc',
                    'back-btn'          => 'Quay lại',
                    'create-new-filter' => 'Tạo Bộ lọc Mới',
                    'custom-filters'    => 'Bộ lọc Tùy chỉnh',
                    'delete-error'      => 'Đã xảy ra lỗi khi xóa bộ lọc, vui lòng thử lại.',
                    'delete-success'    => 'Bộ lọc đã được xóa thành công.',
                    'empty-description' => 'Không có bộ lọc nào được chọn để lưu. Vui lòng chọn bộ lọc để lưu.',
                    'empty-title'       => 'Thêm Bộ lọc để Lưu',
                    'name'              => 'Tên',
                    'quick-filters'     => 'Bộ lọc Nhanh',
                    'save-btn'          => 'Lưu',
                    'save-filter'       => 'Lưu Bộ lọc',
                    'saved-success'     => 'Bộ lọc đã được lưu thành công.',
                    'selected-filters'  => 'Bộ lọc đã Chọn',
                    'title'             => 'Bộ lọc',
                    'update'            => 'Cập nhật',
                    'update-filter'     => 'Cập nhật Bộ lọc',
                    'updated-success'   => 'Bộ lọc đã được cập nhật thành công.',
                ],

                'search' => [
                    'title' => 'Tìm kiếm',
                ],
            ],

            'filters' => [
                'select' => 'Chọn',
                'title'  => 'Bộ lọc',

                'dropdown' => [
                    'searchable' => [
                        'at-least-two-chars' => 'Nhập ít nhất 2 ký tự...',
                        'no-results'         => 'Không tìm thấy kết quả...',
                    ],
                ],

                'custom-filters' => [
                    'clear-all' => 'Xóa tất cả',
                    'title'     => 'Bộ lọc Tùy chỉnh',
                ],

                'boolean-options' => [
                    'false' => 'Sai',
                    'true'  => 'Đúng',
                ],

                'date-options' => [
                    'last-month'        => 'Tháng trước',
                    'last-six-months'   => '6 Tháng trước',
                    'last-three-months' => '3 Tháng trước',
                    'this-month'        => 'Tháng này',
                    'this-week'         => 'Tuần này',
                    'this-year'         => 'Năm nay',
                    'today'             => 'Hôm nay',
                    'yesterday'         => 'Hôm qua',
                ],
            ],

            'table' => [
                'actions'              => 'Hành động',
                'no-records-available' => 'Không có bản ghi nào có sẵn.',
            ],
        ],

        'modal' => [
            'confirm' => [
                'agree-btn'    => 'Đồng ý',
                'disagree-btn' => 'Không đồng ý',
                'message'      => 'Bạn có chắc chắn muốn thực hiện hành động này không?',
                'title'        => 'Bạn có chắc chắn không?',
            ],
        ],

        'tags' => [
            'index' => [
                'title'          => 'Thẻ',
                'added-tags'     => 'Thẻ đã thêm',
                'save-btn'       => 'Lưu Thẻ',
                'placeholder'    => 'Nhập để tìm kiếm thẻ',
                'add-tag'        => 'Thêm \":term\"...',
                'aquarelle-red'  => 'Đỏ Aquarelle',
                'crushed-cashew' => 'Hạt Điều Nghiền',
                'beeswax'        => 'Sáp Ong',
                'lemon-chiffon'  => 'Chiffon Chanh',
                'snow-flurry'    => 'Bông Tuyết',
                'honeydew'       => 'Dưa Lưới',
            ],
        ],

        'layouts' => [
            'header' => [
                'mega-search' => [
                    'title'   => 'Tìm kiếm',

                    'tabs' => [
                        'leads'    => 'Khách hàng tiềm năng',
                        'quotes'   => 'Báo giá',
                        'persons'  => 'Người',
                        'products' => 'Sản phẩm',
                    ],

                    'explore-all-products'          => 'Khám phá tất cả Sản phẩm',
                    'explore-all-leads'             => 'Khám phá tất cả Khách hàng tiềm năng',
                    'explore-all-contacts'          => 'Khám phá tất cả Liên hệ',
                    'explore-all-quotes'            => 'Khám phá tất cả Báo giá',
                    'explore-all-matching-products' => 'Khám phá tất cả Sản phẩm khớp với ":query" (:count)',
                    'explore-all-matching-leads'    => 'Khám phá tất cả Khách hàng tiềm năng khớp với ":query" (:count)',
                    'explore-all-matching-contacts' => 'Khám phá tất cả Liên hệ khớp với ":query" (:count)',
                    'explore-all-matching-quotes'   => 'Khám phá tất cả Báo giá khớp với ":query" (:count)',
                ],
            ],
        ],

        'attributes' => [
            'edit'   => [
                'delete' => 'Xóa',
            ],

            'lookup' => [
                'click-to-add'    => 'Nhấp để thêm',
                'search'          => 'Tìm kiếm',
                'no-result-found' => 'Không tìm thấy kết quả',
                'search'          => 'Tìm kiếm...',
            ],
        ],

        'lookup' => [
            'click-to-add' => 'Nhấp để thêm',
            'no-results'   => 'Không tìm thấy kết quả',
            'add-as-new'   => 'Thêm như Mới',
            'search'       => 'Tìm kiếm...',
        ],

        'flash-group' => [
            'success' => 'Thành công',
            'error'   => 'Lỗi',
            'warning' => 'Cảnh báo',
            'info'    => 'Thông tin',
        ],
    ],

    'quotes' => [
        'index' => [
            'title'          => 'Báo giá',
            'create-btn'     => 'Tạo báo giá',
            'create-success' => 'Báo giá đã được tạo thành công.',
            'update-success' => 'Báo giá đã được cập nhật thành công.',
            'delete-success' => 'Báo giá đã được xóa thành công.',
            'delete-failed'  => 'Không thể xóa báo giá.',

            'datagrid' => [
                'subject'        => 'Chủ đề',
                'sales-person'   => 'Nhân viên kinh doanh',
                'expired-at'     => 'Hết hạn vào',
                'created-at'     => 'Tạo vào',
                'expired-quotes' => 'Báo giá hết hạn',
                'person'         => 'Người',
                'subtotal'       => 'Tổng phụ',
                'discount'       => 'Giảm giá',
                'tax'            => 'Thuế',
                'adjustment'     => 'Điều chỉnh',
                'grand-total'    => 'Tổng cộng',
                'edit'           => 'Chỉnh sửa',
                'delete'         => 'Xóa',
                'print'          => 'In',
            ],

            'pdf' => [
                'title'            => 'Báo giá',
                'grand-total'      => 'Tổng cộng',
                'adjustment'       => 'Điều chỉnh',
                'discount'         => 'Giảm giá',
                'tax'              => 'Thuế',
                'sub-total'        => 'Tổng phụ',
                'amount'           => 'Số tiền',
                'quantity'         => 'Số lượng',
                'price'            => 'Giá',
                'product-name'     => 'Tên sản phẩm',
                'sku'              => 'SKU',
                'shipping-address' => 'Địa chỉ giao hàng',
                'billing-address'  => 'Địa chỉ thanh toán',
                'expired-at'       => 'Hết hạn vào',
                'sales-person'     => 'Nhân viên kinh doanh',
                'date'             => 'Ngày',
                'quote-id'         => 'Mã báo giá',
            ],
        ],

        'create' => [
            'title'             => 'Tạo báo giá',
            'save-btn'          => 'Lưu báo giá',
            'quote-info'        => 'Thông tin báo giá',
            'quote-info-info'   => 'Điền thông tin cơ bản của báo giá.',
            'address-info'      => 'Thông tin địa chỉ',
            'address-info-info' => 'Thông tin địa chỉ liên quan đến báo giá.',
            'quote-items'       => 'Mục báo giá',
            'search-products'   => 'Tìm sản phẩm',
            'link-to-lead'      => 'Liên kết tới khách hàng tiềm năng',
            'quote-item-info'   => 'Thêm yêu cầu sản phẩm cho báo giá này.',
            'quote-name'        => 'Tên báo giá',
            'quantity'          => 'Số lượng',
            'price'             => 'Giá',
            'discount'          => 'Giảm giá',
            'tax'               => 'Thuế',
            'total'             => 'Tổng',
            'amount'            => 'Số tiền',
            'add-item'          => '+ Thêm mục',
            'sub-total'         => 'Tổng phụ (:symbol)',
            'total-discount'    => 'Giảm giá (:symbol)',
            'total-tax'         => 'Thuế (:symbol)',
            'total-adjustment'  => 'Điều chỉnh (:symbol)',
            'grand-total'       => 'Tổng cộng (:symbol)',
            'discount-amount'   => 'Số tiền giảm giá',
            'tax-amount'        => 'Số tiền thuế',
            'adjustment-amount' => 'Số tiền điều chỉnh',
            'product-name'      => 'Tên sản phẩm',
            'action'            => 'Hành động',
        ],

        'edit' => [
            'title'             => 'Chỉnh sửa báo giá',
            'save-btn'          => 'Lưu báo giá',
            'quote-info'        => 'Thông tin báo giá',
            'quote-info-info'   => 'Điền thông tin cơ bản của báo giá.',
            'address-info'      => 'Thông tin địa chỉ',
            'address-info-info' => 'Thông tin địa chỉ liên quan đến báo giá.',
            'quote-items'       => 'Mục báo giá',
            'link-to-lead'      => 'Liên kết tới khách hàng tiềm năng',
            'quote-item-info'   => 'Thêm yêu cầu sản phẩm cho báo giá này.',
            'quote-name'        => 'Tên báo giá',
            'quantity'          => 'Số lượng',
            'price'             => 'Giá',
            'search-products'   => 'Tìm sản phẩm',
            'discount'          => 'Giảm giá',
            'tax'               => 'Thuế',
            'total'             => 'Tổng',
            'amount'            => 'Số tiền',
            'add-item'          => '+ Thêm mục',
            'sub-total'         => 'Tổng phụ (:symbol)',
            'total-discount'    => 'Giảm giá (:symbol)',
            'total-tax'         => 'Thuế (:symbol)',
            'total-adjustment'  => 'Điều chỉnh (:symbol)',
            'grand-total'       => 'Tổng cộng (:symbol)',
            'discount-amount'   => 'Số tiền giảm giá',
            'tax-amount'        => 'Số tiền thuế',
            'adjustment-amount' => 'Số tiền điều chỉnh',
            'product-name'      => 'Tên sản phẩm',
            'action'            => 'Hành động',
        ],
    ],

    'contacts' => [
        'persons' => [
            'index' => [
                'title'          => 'Người liên hệ',
                'create-btn'     => 'Tạo người liên hệ',
                'create-success' => 'Người liên hệ đã được tạo thành công.',
                'update-success' => 'Người liên hệ đã được cập nhật thành công.',
                'delete-success' => 'Người liên hệ đã được xóa thành công.',
                'delete-failed'  => 'Không thể xóa người liên hệ.',

                'datagrid' => [
                    'contact-numbers'   => 'Số liên hệ',
                    'delete'            => 'Xóa',
                    'edit'              => 'Chỉnh sửa',
                    'emails'            => 'Email',
                    'id'                => 'ID',
                    'view'              => 'Xem',
                    'name'              => 'Tên',
                    'organization-name' => 'Tên tổ chức',
                ],
            ],

            'view' => [
                'title'              => ':name',
                'about-person'       => 'Về người liên hệ',
                'about-organization' => 'Về tổ chức',

                'activities' => [
                    'index' => [
                        'all'          => 'Tất cả',
                        'calls'        => 'Cuộc gọi',
                        'meetings'     => 'Cuộc họp',
                        'lunches'      => 'Bữa trưa',
                        'files'        => 'Tệp tin',
                        'quotes'       => 'Báo giá',
                        'notes'        => 'Ghi chú',
                        'emails'       => 'Email',
                        'by-user'      => 'Bởi :user',
                        'scheduled-on' => 'Đã lên lịch vào',
                        'location'     => 'Địa điểm',
                        'participants' => 'Người tham gia',
                        'mark-as-done' => 'Đánh dấu là đã xong',
                        'delete'       => 'Xóa',
                        'edit'         => 'Chỉnh sửa',
                    ],

                    'actions' => [
                        'mail' => [
                            'btn'      => 'Gửi thư',
                            'title'    => 'Soạn thư',
                            'to'       => 'Tới',
                            'cc'       => 'CC',
                            'bcc'      => 'BCC',
                            'subject'  => 'Chủ đề',
                            'send-btn' => 'Gửi',
                            'message'  => 'Tin nhắn',
                        ],

                        'file' => [
                            'btn'           => 'Tệp tin',
                            'title'         => 'Thêm tệp tin',
                            'title-control' => 'Tiêu đề',
                            'name'          => 'Tên tệp',
                            'description'   => 'Mô tả',
                            'file'          => 'Tệp tin',
                            'save-btn'      => 'Lưu tệp tin',
                        ],

                        'note' => [
                            'btn'      => 'Ghi chú',
                            'title'    => 'Thêm ghi chú',
                            'comment'  => 'Bình luận',
                            'save-btn' => 'Lưu ghi chú',
                        ],

                        'activity' => [
                            'btn'           => 'Hoạt động',
                            'title'         => 'Thêm hoạt động',
                            'title-control' => 'Tiêu đề',
                            'description'   => 'Mô tả',
                            'schedule-from' => 'Lịch từ',
                            'schedule-to'   => 'Lịch đến',
                            'location'      => 'Địa điểm',
                            'call'          => 'Cuộc gọi',
                            'meeting'       => 'Cuộc họp',
                            'lunch'         => 'Bữa trưa',
                            'save-btn'      => 'Lưu hoạt động',
                        ],
                    ],
                ],
            ],

            'create' => [
                'title'    => 'Tạo người liên hệ',
                'save-btn' => 'Lưu người liên hệ',
            ],

            'edit' => [
                'title'    => 'Chỉnh sửa người liên hệ',
                'save-btn' => 'Lưu người liên hệ',
            ],
        ],
        'organizations' => [
            'index' => [
                'title'          => 'Tổ chức',
                'create-btn'     => 'Tạo tổ chức',
                'create-success' => 'Tổ chức đã được tạo thành công.',
                'update-success' => 'Tổ chức đã được cập nhật thành công.',
                'delete-success' => 'Tổ chức đã được xóa thành công.',
                'delete-failed'  => 'Không thể xóa tổ chức.',

                'datagrid' => [
                    'delete'        => 'Xóa',
                    'edit'          => 'Chỉnh sửa',
                    'id'            => 'ID',
                    'name'          => 'Tên',
                    'persons-count' => 'Số lượng người',
                ],
            ],

            'create' => [
                'title'    => 'Tạo tổ chức',
                'save-btn' => 'Lưu tổ chức',
            ],

            'edit' => [
                'title'    => 'Chỉnh sửa tổ chức',
                'save-btn' => 'Lưu tổ chức',
            ],
        ],

        'products' => [
            'index' => [
                'title'          => 'Sản phẩm',
                'create-btn'     => 'Tạo sản phẩm',
                'create-success' => 'Sản phẩm đã được tạo thành công.',
                'update-success' => 'Sản phẩm đã được cập nhật thành công.',
                'delete-success' => 'Sản phẩm đã được xóa thành công.',
                'delete-failed'  => 'Không thể xóa sản phẩm.',

                'datagrid'   => [
                    'allocated' => 'Đã phân bổ',
                    'delete'    => 'Xóa',
                    'edit'      => 'Chỉnh sửa',
                    'id'        => 'ID',
                    'in-stock'  => 'Trong kho',
                    'name'      => 'Tên',
                    'on-hand'   => 'Có sẵn',
                    'price'     => 'Giá',
                    'sku'       => 'SKU',
                    'view'      => 'Xem',
                ],
            ],

            'create' => [
                'save-btn'  => 'Lưu sản phẩm',
                'title'     => 'Tạo sản phẩm',
                'general'   => 'Chung',
                'price'     => 'Giá',
            ],

            'edit' => [
                'title'     => 'Chỉnh sửa sản phẩm',
                'save-btn'  => 'Lưu sản phẩm',
                'general'   => 'Chung',
                'price'     => 'Giá',
            ],

            'view' => [
                'sku'         => 'SKU',
                'all'         => 'Tất cả',
                'notes'       => 'Ghi chú',
                'files'       => 'Tệp tin',
                'inventories' => 'Kho hàng',
                'change-logs' => 'Nhật ký thay đổi',

                'attributes' => [
                    'about-product' => 'Về sản phẩm',
                ],

                'inventory' => [
                    'source'     => 'Nguồn',
                    'in-stock'   => 'Trong kho',
                    'allocated'  => 'Đã phân bổ',
                    'on-hand'    => 'Có sẵn',
                    'actions'    => 'Hành động',
                    'assign'     => 'Phân bổ',
                    'add-source' => 'Thêm nguồn',
                    'location'   => 'Địa điểm',
                    'add-more'   => 'Thêm nhiều hơn',
                    'save'       => 'Lưu',
                ],
            ],
        ],

        'settings' => [
            'title' => 'Cài đặt',

            'groups' => [
                'index' => [
                    'create-btn'        => 'Tạo nhóm',
                    'title'             => 'Nhóm',
                    'create-success'    => 'Nhóm đã được tạo thành công.',
                    'update-success'    => 'Nhóm đã được cập nhật thành công.',
                    'destroy-success'   => 'Nhóm đã được xóa thành công.',
                    'delete-failed'     => 'Không thể xóa nhóm.',

                    'datagrid'   => [
                        'delete'      => 'Xóa',
                        'description' => 'Mô tả',
                        'edit'        => 'Chỉnh sửa',
                        'id'          => 'ID',
                        'name'        => 'Tên',
                    ],

                    'edit' => [
                        'title' => 'Chỉnh sửa nhóm',
                    ],

                    'create' => [
                        'name'        => 'Tên',
                        'title'       => 'Tạo nhóm',
                        'description' => 'Mô tả',
                        'save-btn'    => 'Lưu nhóm',
                    ],
                ],
            ],
        ],


        'roles' => [
            'index' => [
                'being-used'                => 'Vai trò không thể bị xóa, vì đang được sử dụng trong người dùng quản trị.',
                'create-btn'                => 'Tạo vai trò',
                'create-success'            => 'Vai trò đã được tạo thành công.',
                'current-role-delete-error' => 'Không thể xóa vai trò được gán cho người dùng hiện tại.',
                'delete-failed'             => 'Vai trò không thể bị xóa.',
                'delete-success'            => 'Vai trò đã được xóa thành công.',
                'last-delete-error'         => 'Cần ít nhất một vai trò.',
                'settings'                  => 'Cài đặt',
                'title'                     => 'Vai trò',
                'update-success'            => 'Vai trò đã được cập nhật thành công.',
                'user-define-error'         => 'Không thể xóa vai trò hệ thống.',

                'datagrid'   => [
                    'all'             => 'Tất cả',
                    'custom'          => 'Tùy chỉnh',
                    'delete'          => 'Xóa',
                    'description'     => 'Mô tả',
                    'edit'            => 'Chỉnh sửa',
                    'id'              => 'ID',
                    'name'            => 'Tên',
                    'permission-type' => 'Loại quyền truy cập',
                ],
            ],

            'create' => [
                'access-control' => 'Quyền truy cập',
                'all'            => 'Tất cả',
                'back-btn'       => 'Quay lại',
                'custom'         => 'Tùy chỉnh',
                'description'    => 'Mô tả',
                'general'        => 'Chung',
                'name'           => 'Tên',
                'permissions'    => 'Quyền truy cập',
                'save-btn'       => 'Lưu vai trò',
                'title'          => 'Tạo vai trò',
            ],

            'edit' => [
                'access-control' => 'Quyền truy cập',
                'all'            => 'Tất cả',
                'back-btn'       => 'Quay lại',
                'custom'         => 'Tùy chỉnh',
                'description'    => 'Mô tả',
                'general'        => 'Chung',
                'name'           => 'Tên',
                'permissions'    => 'Quyền truy cập',
                'save-btn'       => 'Lưu vai trò',
                'title'          => 'Chỉnh sửa vai trò',
            ],
        ],

        'types' => [
            'index' => [
                'create-btn'     => 'Tạo loại',
                'create-success' => 'Loại đã được tạo thành công.',
                'delete-failed'  => 'Loại không thể bị xóa.',
                'delete-success' => 'Loại đã được xóa thành công.',
                'title'          => 'Loại',
                'update-success' => 'Loại đã được cập nhật thành công.',

                'datagrid' => [
                    'delete'      => 'Xóa',
                    'description' => 'Mô tả',
                    'edit'        => 'Chỉnh sửa',
                    'id'          => 'ID',
                    'name'        => 'Tên',
                ],

                'create' => [
                    'name'     => 'Tên',
                    'save-btn' => 'Lưu loại',
                    'title'    => 'Tạo loại',
                ],

                'edit' => [
                    'title' => 'Chỉnh sửa loại',
                ],
            ],
        ],

        'sources' => [
            'index' => [
                'create-btn'     => 'Tạo nguồn',
                'create-success' => 'Nguồn đã được tạo thành công.',
                'delete-failed'  => 'Nguồn không thể bị xóa.',
                'delete-success' => 'Nguồn đã được xóa thành công.',
                'title'          => 'Nguồn',
                'update-success' => 'Nguồn đã được cập nhật thành công.',

                'datagrid' => [
                    'delete' => 'Xóa',
                    'edit'   => 'Chỉnh sửa',
                    'id'     => 'ID',
                    'name'   => 'Tên',
                ],

                'create' => [
                    'name'     => 'Tên',
                    'save-btn' => 'Lưu loại',
                    'title'    => 'Tạo loại',
                ],

                'edit' => [
                    'title' => 'Chỉnh sửa loại',
                ],
            ],
        ],


        'workflows' => [
            'index' => [
                'title'          => 'Quy trình làm việc',
                'create-btn'     => 'Tạo quy trình làm việc',
                'create-success' => 'Quy trình làm việc đã được tạo thành công.',
                'update-success' => 'Quy trình làm việc đã được cập nhật thành công.',
                'delete-success' => 'Quy trình làm việc đã được xóa thành công.',
                'delete-failed'  => 'Quy trình làm việc không thể bị xóa.',
                'datagrid'       => [
                    'delete'      => 'Xóa',
                    'description' => 'Mô tả',
                    'edit'        => 'Chỉnh sửa',
                    'id'          => 'ID',
                    'name'        => 'Tên',
                ],
            ],

            'helpers' => [
                'update-related-leads'       => 'Cập nhật các khách hàng liên quan',
                'send-email-to-sales-owner'  => 'Gửi email đến người phụ trách bán hàng',
                'send-email-to-participants' => 'Gửi email đến người tham gia',
                'add-webhook'                => 'Thêm Webhook',
                'update-lead'                => 'Cập nhật khách hàng',
                'update-person'              => 'Cập nhật người',
                'send-email-to-person'       => 'Gửi email đến người',
                'add-tag'                    => 'Thêm thẻ',
                'add-note-as-activity'       => 'Thêm ghi chú như một hoạt động',
            ],

            'create' => [
                'title'                  => 'Tạo quy trình làm việc',
                'event'                  => 'Sự kiện',
                'back-btn'               => 'Trở lại',
                'save-btn'               => 'Lưu quy trình làm việc',
                'name'                   => 'Tên',
                'basic-details'          => 'Thông tin cơ bản',
                'description'            => 'Mô tả',
                'actions'                => 'Hành động',
                'basic-details-info'     => 'Nhập thông tin cơ bản của quy trình làm việc.',
                'event-info'             => 'Một sự kiện kích hoạt, kiểm tra, điều kiện và thực hiện các hành động đã được định nghĩa trước.',
                'conditions'             => 'Điều kiện',
                'conditions-info'        => 'Điều kiện là các quy tắc kiểm tra kịch bản, được kích hoạt vào những dịp cụ thể.',
                'actions-info'           => 'Một hành động không chỉ giảm bớt khối lượng công việc mà còn giúp tự động hóa CRM dễ dàng hơn.',
                'value'                  => 'Giá trị',
                'condition-type'         => 'Loại điều kiện',
                'all-condition-are-true' => 'Tất cả các điều kiện đều đúng',
                'any-condition-are-true' => 'Bất kỳ điều kiện nào đều đúng',
                'add-condition'          => 'Thêm điều kiện',
                'add-action'             => 'Thêm hành động',
                'yes'                    => 'Có',
                'no'                     => 'Không',
                'email'                  => 'Email',
                'is-equal-to'            => 'Bằng với',
                'is-not-equal-to'        => 'Không bằng',
                'equals-or-greater-than' => 'Bằng hoặc lớn hơn',
                'equals-or-less-than'    => 'Bằng hoặc nhỏ hơn',
                'greater-than'           => 'Lớn hơn',
                'less-than'              => 'Nhỏ hơn',
                'type'                   => 'Loại',
                'contain'                => 'Chứa',
                'contains'               => 'Chứa',
                'does-not-contain'       => 'Không chứa',
            ],

            'edit' => [
                'title'                  => 'Chỉnh sửa quy trình làm việc',
                'event'                  => 'Sự kiện',
                'back-btn'               => 'Trở lại',
                'save-btn'               => 'Lưu quy trình làm việc',
                'name'                   => 'Tên',
                'basic-details'          => 'Thông tin cơ bản',
                'description'            => 'Mô tả',
                'actions'                => 'Hành động',
                'type'                   => 'Loại',
                'basic-details-info'     => 'Nhập thông tin cơ bản của quy trình làm việc.',
                'event-info'             => 'Một sự kiện kích hoạt, kiểm tra, điều kiện và thực hiện các hành động đã được định nghĩa trước.',
                'conditions'             => 'Điều kiện',
                'conditions-info'        => 'Điều kiện là các quy tắc kiểm tra kịch bản, được kích hoạt vào những dịp cụ thể.',
                'actions-info'           => 'Một hành động không chỉ giảm bớt khối lượng công việc mà còn giúp tự động hóa CRM dễ dàng hơn.',
                'value'                  => 'Giá trị',
                'condition-type'         => 'Loại điều kiện',
                'all-condition-are-true' => 'Tất cả các điều kiện đều đúng',
                'any-condition-are-true' => 'Bất kỳ điều kiện nào đều đúng',
                'add-condition'          => 'Thêm điều kiện',
                'add-action'             => 'Thêm hành động',
                'yes'                    => 'Có',
                'no'                     => 'Không',
                'email'                  => 'Email',
                'is-equal-to'            => 'Bằng với',
                'is-not-equal-to'        => 'Không bằng',
                'equals-or-greater-than' => 'Bằng hoặc lớn hơn',
                'equals-or-less-than'    => 'Bằng hoặc nhỏ hơn',
                'greater-than'           => 'Lớn hơn',
                'less-than'              => 'Nhỏ hơn',
                'contain'                => 'Chứa',
                'contains'               => 'Chứa',
                'does-not-contain'       => 'Không chứa',
            ],

        ],

        'webforms' => [
            'index' => [
                'title'          => 'Biểu mẫu web',
                'create-btn'     => 'Tạo biểu mẫu web',
                'create-success' => 'Biểu mẫu web đã được tạo thành công.',
                'update-success' => 'Biểu mẫu web đã được cập nhật thành công.',
                'delete-success' => 'Biểu mẫu web đã được xóa thành công.',
                'delete-failed'  => 'Biểu mẫu web không thể bị xóa.',

                'datagrid'       => [
                    'id'     => 'ID',
                    'title'  => 'Tiêu đề',
                    'edit'   => 'Chỉnh sửa',
                    'delete' => 'Xóa',
                ],
            ],

            'create' => [
                'title'                    => 'Tạo biểu mẫu web',
                'add-attribute-btn'        => 'Thêm nút thuộc tính',
                'attribute-label-color'    => 'Màu nhãn thuộc tính',
                'attributes'               => 'Thuộc tính',
                'attributes-info'          => 'Thêm thuộc tính tùy chỉnh vào biểu mẫu.',
                'background-color'         => 'Màu nền',
                'create-lead'              => 'Tạo khách hàng',
                'customize-webform'        => 'Tùy chỉnh biểu mẫu web',
                'customize-webform-info'   => 'Tùy chỉnh biểu mẫu của bạn với màu sắc phần tử theo lựa chọn của bạn.',
                'description'              => 'Mô tả',
                'display-custom-message'   => 'Hiển thị thông điệp tùy chỉnh',
                'form-background-color'    => 'Màu nền biểu mẫu',
                'form-submit-btn-color'    => 'Màu nút gửi biểu mẫu',
                'form-submit-button-color'  => 'Màu nút gửi biểu mẫu',
                'form-title-color'         => 'Màu tiêu đề biểu mẫu',
                'general'                  => 'Chung',
                'leads'                    => 'Khách hàng',
                'person'                   => 'Người',
                'save-btn'                 => 'Lưu biểu mẫu web',
                'submit-button-label'      => 'Nhãn nút gửi',
                'submit-success-action'    => 'Hành động thành công khi gửi',
                'redirect-to-url'          => 'Chuyển hướng đến URL',
                'choose-value'             => 'Chọn giá trị',
                'select-file'              => 'Chọn tệp',
                'select-image'             => 'Chọn hình ảnh',
                'enter-value'              => 'Nhập giá trị',
            ],

            'edit' => [
                'title'                     => 'Chỉnh sửa biểu mẫu web',
                'add-attribute-btn'         => 'Thêm nút thuộc tính',
                'attribute-label-color'     => 'Màu nhãn thuộc tính',
                'attributes'                => 'Thuộc tính',
                'attributes-info'           => 'Thêm thuộc tính tùy chỉnh vào biểu mẫu.',
                'background-color'          => 'Màu nền',
                'code-snippet'              => 'Đoạn mã',
                'copied'                    => 'Đã sao chép',
                'copy'                      => 'Sao chép',
                'create-lead'               => 'Tạo khách hàng',
                'customize-webform'         => 'Tùy chỉnh biểu mẫu web',
                'customize-webform-info'    => 'Tùy chỉnh biểu mẫu của bạn với màu sắc phần tử theo lựa chọn của bạn.',
                'description'               => 'Mô tả',
                'display-custom-message'    => 'Hiển thị thông điệp tùy chỉnh',
                'embed'                     => 'Nhúng',
                'form-background-color'     => 'Màu nền biểu mẫu',
                'form-submit-btn-color'     => 'Màu nút gửi biểu mẫu',
                'form-submit-button-color'   => 'Màu nút gửi biểu mẫu',
                'form-title-color'          => 'Màu tiêu đề biểu mẫu',
                'general'                   => 'Chung',
                'preview'                   => 'Xem trước',
                'person'                    => 'Người',
                'public-url'                => 'URL công khai',
                'redirect-to-url'           => 'Chuyển hướng đến URL',
                'save-btn'                  => 'Lưu biểu mẫu web',
                'submit-button-label'       => 'Nhãn nút gửi',
                'submit-success-action'     => 'Hành động thành công khi gửi',
                'choose-value'              => 'Chọn giá trị',
                'select-file'               => 'Chọn tệp',
                'select-image'              => 'Chọn hình ảnh',
                'enter-value'               => 'Nhập giá trị',
            ],
        ],


        'email-template' => [
            'index' => [
                'create-btn'     => 'Tạo mẫu email',
                'title'          => 'Mẫu email',
                'create-success' => 'Mẫu email đã được tạo thành công.',
                'update-success' => 'Mẫu email đã được cập nhật thành công.',
                'delete-success' => 'Mẫu email đã được xóa thành công.',
                'delete-failed'  => 'Mẫu email không thể bị xóa.',

                'datagrid'   => [
                    'delete'       => 'Xóa',
                    'edit'         => 'Chỉnh sửa',
                    'id'           => 'ID',
                    'name'         => 'Tên',
                    'subject'      => 'Chủ đề',
                ],
            ],

            'create'     => [
                'title'                => 'Tạo mẫu email',
                'save-btn'             => 'Lưu mẫu email',
                'email-template'       => 'Mẫu email',
                'subject'              => 'Chủ đề',
                'content'              => 'Nội dung',
                'subject-placeholders' => 'Thay thế cho chủ đề',
                'general'              => 'Chung',
                'name'                 => 'Tên',
            ],

            'edit' => [
                'title'                => 'Chỉnh sửa mẫu email',
                'save-btn'             => 'Lưu mẫu email',
                'email-template'       => 'Mẫu email',
                'subject'              => 'Chủ đề',
                'content'              => 'Nội dung',
                'subject-placeholders' => 'Thay thế cho chủ đề',
                'general'              => 'Chung',
                'name'                 => 'Tên',
            ],
        ],

        'tags' => [
            'index' => [
                'create-btn'     => 'Tạo thẻ',
                'title'          => 'Thẻ',
                'create-success' => 'Thẻ đã được tạo thành công.',
                'update-success' => 'Thẻ đã được cập nhật thành công.',
                'delete-success' => 'Thẻ đã được xóa thành công.',
                'delete-failed'  => 'Thẻ không thể bị xóa.',

                'datagrid' => [
                    'delete'      => 'Xóa',
                    'edit'        => 'Chỉnh sửa',
                    'id'          => 'ID',
                    'name'        => 'Tên',
                    'users'       => 'Người dùng',
                    'created-at'  => 'Ngày tạo',
                ],

                'create' => [
                    'name'     => 'Tên',
                    'save-btn' => 'Lưu thẻ',
                    'title'    => 'Tạo thẻ',
                    'color'    => 'Màu',
                ],

                'edit' => [
                    'title' => 'Chỉnh sửa thẻ',
                ],
            ],
        ],


        'users' => [
            'index' => [
                'create-btn'          => 'Tạo người dùng',
                'create-success'      => 'Người dùng đã được tạo thành công.',
                'delete-failed'       => 'Người dùng không thể bị xóa.',
                'delete-success'      => 'Người dùng đã được xóa thành công.',
                'last-delete-error'   => 'Cần ít nhất một người dùng.',
                'mass-delete-failed'  => 'Người dùng không thể bị xóa.',
                'mass-delete-success' => 'Người dùng đã được xóa thành công.',
                'mass-update-failed'  => 'Người dùng không thể được cập nhật.',
                'mass-update-success' => 'Người dùng đã được cập nhật thành công.',
                'title'               => 'Người dùng',
                'update-success'      => 'Người dùng đã được cập nhật thành công.',
                'user-define-error'   => 'Không thể xóa người dùng hệ thống.',
                'active'              => 'Kích hoạt',
                'inactive'            => 'Không kích hoạt',

                'datagrid' => [
                    'active'        => 'Kích hoạt',
                    'created-at'    => 'Ngày tạo',
                    'delete'        => 'Xóa',
                    'edit'          => 'Chỉnh sửa',
                    'email'         => 'Email',
                    'id'            => 'ID',
                    'inactive'      => 'Không kích hoạt',
                    'name'          => 'Tên',
                    'status'        => 'Trạng thái',
                    'update-status' => 'Cập nhật trạng thái',
                    'users'         => 'Người dùng',
                ],

                'create' => [
                    'confirm-password' => 'Xác nhận mật khẩu',
                    'email'            => 'Email',
                    'general'          => 'Chung',
                    'global'           => 'Toàn cầu',
                    'group'            => 'Nhóm',
                    'individual'       => 'Cá nhân',
                    'name'             => 'Tên',
                    'password'         => 'Mật khẩu',
                    'permission'       => 'Quyền',
                    'role'             => 'Vai trò',
                    'save-btn'         => 'Lưu người dùng',
                    'status'           => 'Trạng thái',
                    'title'            => 'Tạo người dùng',
                    'view-permission'  => 'Quyền xem',
                ],

                'edit' => [
                    'title' => 'Chỉnh sửa người dùng',
                ],
            ],
        ],

        'pipelines' => [
            'index' => [
                'title'                => 'Pipeline',
                'create-btn'           => 'Tạo pipeline',
                'create-success'       => 'Pipeline đã được tạo thành công.',
                'update-success'       => 'Pipeline đã được cập nhật thành công.',
                'delete-success'       => 'Pipeline đã được xóa thành công.',
                'delete-failed'        => 'Pipeline không thể bị xóa.',
                'default-delete-error' => 'Pipeline mặc định không thể bị xóa.',

                'datagrid' => [
                    'delete'      => 'Xóa',
                    'edit'        => 'Chỉnh sửa',
                    'id'          => 'ID',
                    'is-default'  => 'Là mặc định',
                    'name'        => 'Tên',
                    'no'          => 'Không',
                    'rotten-days' => 'Ngày hỏng',
                    'yes'         => 'Có',
                ],
            ],

            'create' => [
                'title'                => 'Tạo pipeline',
                'save-btn'             => 'Lưu pipeline',
                'name'                 => 'Tên',
                'rotten-days'          => 'Ngày hỏng',
                'mark-as-default'      => 'Đánh dấu là mặc định',
                'general'              => 'Chung',
                'probability'          => 'Xác suất (%)',
                'new-stage'            => 'Mới',
                'won-stage'            => 'Đã thắng',
                'lost-stage'           => 'Đã thua',
                'stage-btn'            => 'Thêm giai đoạn',
                'stages'               => 'Các giai đoạn',
                'duplicate-name'       => 'Trường "Tên" không được trùng lặp',
                'delete-stage'         => 'Xóa giai đoạn',
                'add-new-stages'       => 'Thêm các giai đoạn mới',
                'add-stage-info'       => 'Thêm giai đoạn mới cho Pipeline của bạn',
                'newly-added'          => 'Mới được thêm',
                'stage-delete-success' => 'Giai đoạn đã được xóa thành công',
            ],

            'edit'  => [
                'title'                => 'Chỉnh sửa pipeline',
                'save-btn'             => 'Lưu pipeline',
                'name'                 => 'Tên',
                'rotten-days'          => 'Ngày hỏng',
                'mark-as-default'      => 'Đánh dấu là mặc định',
                'general'              => 'Chung',
                'probability'          => 'Xác suất (%)',
                'new-stage'            => 'Mới',
                'won-stage'            => 'Đã thắng',
                'lost-stage'           => 'Đã thua',
                'stage-btn'            => 'Thêm giai đoạn',
                'stages'               => 'Các giai đoạn',
                'duplicate-name'       => 'Trường "Tên" không được trùng lặp',
                'delete-stage'         => 'Xóa giai đoạn',
                'add-new-stages'       => 'Thêm các giai đoạn mới',
                'add-stage-info'       => 'Thêm giai đoạn mới cho Pipeline của bạn',
                'stage-delete-success' => 'Giai đoạn đã được xóa thành công',
            ],
        ],


        'webhooks' => [
            'index' => [
                'title'          => 'Webhooks',
                'create-btn'     => 'Tạo Webhook',
                'create-success' => 'Webhook đã được tạo thành công.',
                'update-success' => 'Webhook đã được cập nhật thành công.',
                'delete-success' => 'Webhook đã được xóa thành công.',
                'delete-failed'  => 'Webhook không thể bị xóa.',

                'datagrid' => [
                    'id'          => 'ID',
                    'delete'      => 'Xóa',
                    'edit'        => 'Chỉnh sửa',
                    'name'        => 'Tên',
                    'entity-type' => 'Loại thực thể',
                    'end-point'   => 'Điểm cuối',
                ],
            ],

            'create' => [
                'title'                 => 'Tạo Webhook',
                'save-btn'              => 'Lưu Webhook',
                'info'                  => 'Nhập chi tiết webhook',
                'url-and-parameters'    => 'URL và tham số',
                'method'                => 'Phương thức',
                'post'                  => 'Post',
                'put'                   => 'Put',
                'url-endpoint'          => 'Địa chỉ URL điểm cuối',
                'parameters'            => 'Tham số',
                'add-new-parameter'     => 'Thêm tham số mới',
                'url-preview'           => 'Xem trước URL:',
                'headers'               => 'Tiêu đề',
                'add-new-header'        => 'Thêm tiêu đề mới',
                'body'                  => 'Nội dung',
                'default'               => 'Mặc định',
                'x-www-form-urlencoded' => 'x-www-form-urlencoded',
                'key-and-value'         => 'Khóa và Giá trị',
                'add-new-payload'       => 'Thêm payload mới',
                'raw'                   => 'Thô',
                'general'               => 'Chung',
                'name'                  => 'Tên',
                'entity-type'           => 'Loại thực thể',
                'insert-placeholder'    => 'Chèn Placeholder',
                'description'           => 'Mô tả',
                'json'                  => 'Json',
                'text'                  => 'Văn bản',
            ],

            'edit' => [
                'title'                 => 'Chỉnh sửa Webhook',
                'edit-btn'              => 'Lưu Webhook',
                'save-btn'              => 'Lưu Webhook',
                'info'                  => 'Nhập chi tiết webhook',
                'url-and-parameters'    => 'URL và tham số',
                'method'                => 'Phương thức',
                'post'                  => 'Post',
                'put'                   => 'Put',
                'url-endpoint'          => 'Địa chỉ URL điểm cuối',
                'parameters'            => 'Tham số',
                'add-new-parameter'     => 'Thêm tham số mới',
                'url-preview'           => 'Xem trước URL:',
                'headers'               => 'Tiêu đề',
                'add-new-header'        => 'Thêm tiêu đề mới',
                'body'                  => 'Nội dung',
                'default'               => 'Mặc định',
                'x-www-form-urlencoded' => 'x-www-form-urlencoded',
                'key-and-value'         => 'Khóa và Giá trị',
                'add-new-payload'       => 'Thêm payload mới',
                'raw'                   => 'Thô',
                'general'               => 'Chung',
                'name'                  => 'Tên',
                'entity-type'           => 'Loại thực thể',
                'insert-placeholder'    => 'Chèn Placeholder',
                'description'           => 'Mô tả',
                'json'                  => 'Json',
                'text'                  => 'Văn bản',
            ],
        ],

        'warehouses' => [
            'index' => [
                'title'          => 'Kho hàng',
                'create-btn'     => 'Tạo Kho hàng',
                'create-success' => 'Kho hàng đã được tạo thành công.',
                'name-exists'    => 'Tên kho hàng đã tồn tại.',
                'update-success' => 'Kho hàng đã được cập nhật thành công.',
                'delete-success' => 'Kho hàng đã được xóa thành công.',
                'delete-failed'  => 'Kho hàng không thể bị xóa.',

                'datagrid' => [
                    'id'              => 'ID',
                    'name'            => 'Tên',
                    'contact-name'    => 'Tên người liên hệ',
                    'delete'          => 'Xóa',
                    'edit'            => 'Chỉnh sửa',
                    'view'            => 'Xem',
                    'created-at'      => 'Ngày tạo',
                    'products'        => 'Sản phẩm',
                    'contact-emails'  => 'Email liên hệ',
                    'contact-numbers' => 'Số điện thoại liên hệ',
                ],
            ],

            'create' => [
                'title'         => 'Tạo Kho hàng',
                'save-btn'      => 'Lưu Kho hàng',
                'contact-info'  => 'Thông tin liên hệ',
            ],

            'edit' => [
                'title'         => 'Chỉnh sửa Kho hàng',
                'save-btn'      => 'Lưu Kho hàng',
                'contact-info'  => 'Thông tin liên hệ',
            ],

            'view' => [
                'all'         => 'Tất cả',
                'notes'       => 'Ghi chú',
                'files'       => 'Tài liệu',
                'location'    => 'Địa điểm',
                'change-logs' => 'Nhật ký thay đổi',

                'locations' => [
                    'action'         => 'Hành động',
                    'add-location'   => 'Thêm Địa điểm',
                    'create-success' => 'Địa điểm đã được tạo thành công.',
                    'delete'         => 'Xóa',
                    'delete-failed'  => 'Địa điểm không thể bị xóa.',
                    'delete-success' => 'Địa điểm đã được xóa thành công.',
                    'name'           => 'Tên',
                    'save-btn'       => 'Lưu',
                ],

                'general-information' => [
                    'title' => 'Thông tin chung',
                ],

                'contact-information' => [
                    'title' => 'Thông tin liên hệ',
                ],
            ],
        ],


        'attributes' => [
            'index' => [
                'title'              => 'Thuộc tính',
                'create-btn'         => 'Tạo thuộc tính',
                'create-success'     => 'Thuộc tính đã được tạo thành công.',
                'update-success'     => 'Thuộc tính đã được cập nhật thành công.',
                'delete-success'     => 'Thuộc tính đã được xóa thành công.',
                'delete-failed'      => 'Không thể xóa thuộc tính.',
                'user-define-error'  => 'Không thể xóa thuộc tính hệ thống.',
                'mass-delete-failed' => 'Không thể xóa thuộc tính hệ thống.',

                'datagrid' => [
                    'yes'         => 'Có',
                    'no'          => 'Không',
                    'id'          => 'ID',
                    'code'        => 'Mã',
                    'name'        => 'Tên',
                    'entity-type' => 'Loại thực thể',
                    'type'        => 'Loại',
                    'is-default'  => 'Là mặc định',
                    'edit'        => 'Chỉnh sửa',
                    'delete'      => 'Xóa',
                ],
            ],

            'create' => [
                'title'                 => 'Tạo thuộc tính',
                'save-btn'              => 'Lưu thuộc tính',
                'code'                  => 'Mã',
                'name'                  => 'Tên',
                'entity-type'           => 'Loại thực thể',
                'type'                  => 'Loại',
                'validations'           => 'Xác thực',
                'is-required'           => 'Là bắt buộc',
                'input-validation'      => 'Xác thực đầu vào',
                'is-unique'             => 'Là duy nhất',
                'labels'                => 'Nhãn',
                'general'               => 'Chung',
                'numeric'               => 'Số',
                'decimal'               => 'Thập phân',
                'url'                   => 'URL',
                'options'               => 'Tùy chọn',
                'option-type'           => 'Loại tùy chọn',
                'lookup-type'           => 'Loại tìm kiếm',
                'add-option'            => 'Thêm tùy chọn',
                'save-option'           => 'Lưu tùy chọn',
                'option-name'           => 'Tên tùy chọn',
                'add-attribute-options' => 'Thêm tùy chọn thuộc tính',
                'text'                  => 'Văn bản',
                'textarea'              => 'Văn bản nhiều dòng',
                'price'                 => 'Giá',
                'boolean'               => 'Boolean',
                'select'                => 'Chọn',
                'multiselect'           => 'Chọn nhiều',
                'email'                 => 'Email',
                'address'               => 'Địa chỉ',
                'phone'                 => 'Điện thoại',
                'datetime'              => 'Ngày giờ',
                'date'                  => 'Ngày',
                'image'                 => 'Hình ảnh',
                'file'                  => 'Tập tin',
                'lookup'                => 'Tìm kiếm',
                'entity_type'           => 'Loại thực thể',
                'checkbox'              => 'Checkbox',
                'is_required'           => 'Là bắt buộc',
                'is_unique'             => 'Là duy nhất',
                'actions'               => 'Hành động',
            ],

            'edit' => [
                'title'                 => 'Chỉnh sửa thuộc tính',
                'save-btn'              => 'Lưu thuộc tính',
                'code'                  => 'Mã',
                'name'                  => 'Tên',
                'labels'                => 'Nhãn',
                'entity-type'           => 'Loại thực thể',
                'type'                  => 'Loại',
                'validations'           => 'Xác thực',
                'is-required'           => 'Là bắt buộc',
                'input-validation'      => 'Xác thực đầu vào',
                'is-unique'             => 'Là duy nhất',
                'general'               => 'Chung',
                'numeric'               => 'Số',
                'decimal'               => 'Thập phân',
                'url'                   => 'URL',
                'options'               => 'Tùy chọn',
                'option-type'           => 'Loại tùy chọn',
                'lookup-type'           => 'Loại tìm kiếm',
                'add-option'            => 'Thêm tùy chọn',
                'save-option'           => 'Lưu tùy chọn',
                'option-name'           => 'Tên tùy chọn',
                'add-attribute-options' => 'Thêm tùy chọn thuộc tính',
                'text'                  => 'Văn bản',
                'textarea'              => 'Văn bản nhiều dòng',
                'price'                 => 'Giá',
                'boolean'               => 'Boolean',
                'select'                => 'Chọn',
                'multiselect'           => 'Chọn nhiều',
                'email'                 => 'Email',
                'address'               => 'Địa chỉ',
                'phone'                 => 'Điện thoại',
                'datetime'              => 'Ngày giờ',
                'date'                  => 'Ngày',
                'image'                 => 'Hình ảnh',
                'file'                  => 'Tập tin',
                'lookup'                => 'Tìm kiếm',
                'entity_type'           => 'Loại thực thể',
                'checkbox'              => 'Checkbox',
                'is_required'           => 'Là bắt buộc',
                'is_unique'             => 'Là duy nhất',
                'actions'               => 'Hành động',
            ],
        ],

        'activities' => [
            'index' => [
                'title'      => 'Hoạt động',

                'datagrid' => [
                    'comment'       => 'Nhận xét',
                    'created_at'    => 'Ngày tạo',
                    'created_by'    => 'Người tạo',
                    'edit'          => 'Chỉnh sửa',
                    'id'            => 'ID',
                    'done'          => 'Đã hoàn thành',
                    'not-done'      => 'Chưa hoàn thành',
                    'lead'          => 'Khách hàng tiềm năng',
                    'mass-delete'   => 'Xóa hàng loạt',
                    'mass-update'   => 'Cập nhật hàng loạt',
                    'schedule-from' => 'Lên lịch từ',
                    'schedule-to'   => 'Lên lịch đến',
                    'schedule_from' => 'Lên lịch từ',
                    'schedule_to'   => 'Lên lịch đến',
                    'title'         => 'Tiêu đề',
                    'is_done'       => 'Đã hoàn thành',
                    'type'          => 'Loại',
                    'update'        => 'Cập nhật',
                    'call'          => 'Cuộc gọi',
                    'meeting'       => 'Cuộc họp',
                    'lunch'         => 'Bữa trưa',
                ],
            ],

            'edit' => [
                'title'           => 'Chỉnh sửa hoạt động',
                'back-btn'        => 'Trở lại',
                'save-btn'        => 'Lưu hoạt động',
                'type'            => 'Loại hoạt động',
                'call'            => 'Cuộc gọi',
                'meeting'         => 'Cuộc họp',
                'lunch'           => 'Bữa trưa',
                'schedule_to'     => 'Lên lịch đến',
                'schedule_from'   => 'Lên lịch từ',
                'location'        => 'Địa điểm',
                'comment'         => 'Nhận xét',
                'lead'            => 'Khách hàng tiềm năng',
                'participants'    => 'Người tham gia',
                'general'         => 'Chung',
                'persons'         => 'Người',
                'no-result-found' => 'Không tìm thấy bản ghi.',
                'users'           => 'Người dùng',
            ],

            'updated'              => 'Đã cập nhật :attribute',
            'created'              => 'Đã tạo',
            'duration-overlapping' => 'Người tham gia có cuộc họp khác vào thời điểm này. Bạn có muốn tiếp tục không?',
            'create-success'       => 'Hoạt động đã được tạo thành công.',
            'update-success'       => 'Hoạt động đã được cập nhật thành công.',
            'overlapping-error'    => 'Người tham gia có cuộc họp khác vào thời điểm này.',
            'mass-update-success'  => 'Các hoạt động đã được cập nhật thành công.',
            'destroy-success'      => 'Hoạt động đã được xóa thành công.',
            'delete-failed'        => 'Không thể xóa hoạt động.',
        ],
    ],

    'mail' => [
        'index' => [
            'compose'           => 'Soạn thư',
            'draft'             => 'Nháp',
            'inbox'             => 'Hộp thư đến',
            'outbox'            => 'Hộp thư đi',
            'sent'              => 'Đã gửi',
            'trash'             => 'Thùng rác',
            'compose-mail-btn'  => 'Soạn Thư',
            'btn'               => 'Thư',
            'mail'              => [
                'title'         => 'Soạn thư',
                'to'            => 'Đến',
                'enter-emails'  => 'Nhấn Enter để thêm email',
                'cc'            => 'CC',
                'bcc'           => 'BCC',
                'subject'       => 'Chủ đề',
                'send-btn'      => 'Gửi',
                'message'       => 'Nội dung',
                'draft'         => 'Nháp',
            ],

            'datagrid' => [
                'id'            => 'ID',
                'from'          => 'Từ',
                'to'            => 'Đến',
                'subject'       => 'Chủ đề',
                'tag-name'      => 'Tên thẻ',
                'created-at'    => 'Ngày tạo',
                'move-to-inbox' => 'Chuyển đến hộp thư đến',
                'edit'          => 'Chỉnh sửa',
                'view'          => 'Xem',
                'delete'        => 'Xóa',
            ],
        ],

        'create-success'      => 'Email đã được gửi thành công.',
        'update-success'      => 'Email đã được cập nhật thành công.',
        'mass-update-success' => 'Các email đã được cập nhật thành công.',
        'delete-success'      => 'Email đã được xóa thành công.',
        'delete-failed'       => 'Email không thể bị xóa.',

        'view' => [
            'title'                      => 'Thư',
            'subject'                    => ':subject',
            'link-mail'                  => 'Liên kết Thư',
            'to'                         => 'Đến',
            'cc'                         => 'CC',
            'bcc'                        => 'BCC',
            'reply'                      => 'Phản hồi',
            'reply-all'                  => 'Phản hồi tất cả',
            'forward'                    => 'Chuyển tiếp',
            'delete'                     => 'Xóa',
            'enter-mails'                => 'Nhập ID email',
            'rotten-days'                => 'Khách hàng tiềm năng đã hỏng trong :days ngày',
            'search-an-existing-lead'    => 'Tìm kiếm khách hàng tiềm năng hiện có',
            'search-an-existing-contact' => 'Tìm kiếm liên hệ hiện có',
            'message'                    => 'Nội dung',
            'add-attachments'            => 'Thêm tệp đính kèm',
            'discard'                    => 'Hủy bỏ',
            'send'                       => 'Gửi',
            'no-result-found'            => 'Không tìm thấy kết quả',
            'add-new-contact'            => 'Thêm liên hệ mới',
            'description'                => 'Mô tả',
            'search'                     => 'Tìm kiếm...',
            'add-new-lead'               => 'Thêm khách hàng tiềm năng mới',
            'create-new-contact'         => 'Tạo liên hệ mới',
            'save-contact'               => 'Lưu liên hệ',
            'create-lead'                => 'Tạo khách hàng tiềm năng',
            'linked-contact'             => 'Liên hệ đã liên kết',
            'link-to-contact'            => 'Liên kết với liên hệ',
            'link-to-lead'               => 'Liên kết với khách hàng tiềm năng',
            'linked-lead'                => 'Khách hàng tiềm năng đã liên kết',
            'lead-details'               => 'Chi tiết khách hàng tiềm năng',
            'contact-person'             => 'Người liên hệ',
            'product'                    => 'Sản phẩm',

            'tags' => [
                'create-success'  => 'Thẻ đã được tạo thành công.',
                'destroy-success' => 'Thẻ đã được xóa thành công.',
            ],
        ],
    ],

    'common' => [
        'custom-attributes' => [
            'select-country' => 'Chọn quốc gia',
            'select-state'   => 'Chọn bang',
            'state'          => 'Bang',
            'city'           => 'Thành phố',
            'postcode'       => 'Mã bưu điện',
            'work'           => 'Công việc',
            'home'           => 'Nhà',
            'add-more'       => 'Thêm nhiều',
            'select'         => 'Chọn',
            'country'        => 'Quốc gia',
            'address'        => 'Địa chỉ',
        ],
    ],


    'leads' => [
        'create-success'    => 'Khách hàng tiềm năng đã được tạo thành công.',
        'update-success'    => 'Khách hàng tiềm năng đã được cập nhật thành công.',
        'destroy-success'   => 'Khách hàng tiềm năng đã được xóa thành công.',
        'destroy-failed'    => 'Khách hàng tiềm năng không thể bị xóa.',

        'index' => [
            'title'      => 'Khách hàng tiềm năng',
            'customer'   => 'Khách hàng hiện hữu',
            'create-btn' => 'Tạo khách hàng tiềm năng',

            'datagrid' => [
                'id'                  => 'ID',
                'sales-person'        => 'Nhân viên bán hàng',
                'subject'             => 'Chủ đề',
                'source'              => 'Nguồn',
                'lead-value'          => 'Giá trị khách hàng tiềm năng',
                // 'lead-type'           => 'Loại khách hàng tiềm năng',
                'lead-type'           => 'Chi nhánh',
                'tag-name'            => 'Tên thẻ',
                'contact-person'      => 'Người liên hệ',
                'stage'               => 'Giai đoạn',
                'rotten-lead'         => 'Khách hàng tiềm năng đã hỏng',
                'expected-close-date' => 'Ngày đóng dự kiến',
                'created-at'          => 'Ngày tạo',
                'no'                  => 'Không',
                'yes'                 => 'Có',
                'delete'              => 'Xóa',
                'mass-delete'         => 'Xóa hàng loạt',
                'mass-update'         => 'Cập nhật hàng loạt',
            ],

            'kanban' => [
                'rotten-days'            => 'Khách hàng tiềm năng đã hỏng trong :days ngày',
                'empty-list'             => 'Danh sách khách hàng tiềm năng của bạn trống',
                'empty-list-description' => 'Tạo một khách hàng tiềm năng để tổ chức các mục tiêu của bạn.',
                'create-lead-btn'        => 'Tạo khách hàng tiềm năng',

                'columns' => [
                    'contact-person'      => 'Người liên hệ',
                    'id'                  => 'ID',
                    // 'lead-type'           => 'Loại khách hàng tiềm năng',
                    'lead-value'          => 'Chi nhánh',
                    'sales-person'        => 'Nhân viên bán hàng',
                    'source'              => 'Nguồn',
                    'title'               => 'Tiêu đề',
                    'tags'                => 'Thẻ',
                    'expected-close-date' => 'Ngày đóng dự kiến',
                    'created-at'          => 'Ngày tạo',
                ],

                'toolbar' => [
                    'search' => [
                        'title' => 'Tìm kiếm',
                    ],

                    'filters' => [
                        'apply-filters' => 'Áp dụng bộ lọc',
                        'clear-all'     => 'Xóa tất cả',
                        'filter'        => 'Bộ lọc',
                        'filters'       => 'Các bộ lọc',
                        'select'        => 'Chọn',
                    ],
                ],
            ],

            'view-switcher' => [
                'all-pipelines'       => 'Tất cả các đường ống',
                'create-new-pipeline' => 'Tạo đường ống mới',
            ],
        ],

        'create' => [
            'title'          => 'Tạo khách hàng tiềm năng',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của khách hàng tiềm năng',
            'contact-person' => 'Người liên hệ',
            'contact-info'   => 'Thông tin về người liên hệ',
            'products'       => 'Sản phẩm',
            'products-info'  => 'Thông tin về sản phẩm',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa khách hàng tiềm năng',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của khách hàng tiềm năng',
            'contact-person' => 'Người liên hệ',
            'contact-info'   => 'Thông tin về người liên hệ',
            'products'       => 'Sản phẩm',
            'products-info'  => 'Thông tin về sản phẩm',
        ],

        'common' => [
            'contact' => [
                'name'           => 'Tên',
                'email'          => 'Email',
                'contact-number' => 'Số điện thoại',
                'organization'   => 'Tổ chức',
            ],

            'products' => [
                'product-name' => 'Tên sản phẩm',
                'quantity'     => 'Số lượng',
                'price'        => 'Giá',
                'amount'       => 'Số tiền',
                'action'       => 'Hành động',
                'add-more'     => 'Thêm nhiều',
                'total'        => 'Tổng',
            ],
        ],

        'view' => [
            'title'       => 'Khách hàng tiềm năng: :title',
            'rotten-days' => ':days Ngày',

            'tabs'        => [
                'description' => 'Mô tả',
                'products'    => 'Sản phẩm',
                'quotes'      => 'Báo giá',
            ],

            'attributes' => [
                'title' => 'Thông tin về khách hàng tiềm năng',
            ],

            'quotes'=> [
                'subject'         => 'Chủ đề',
                'expired-at'      => 'Hết hạn vào',
                'sub-total'       => 'Tổng phụ',
                'discount'        => 'Giảm giá',
                'tax'             => 'Thuế',
                'adjustment'      => 'Điều chỉnh',
                'grand-total'     => 'Tổng cộng',
                'delete'          => 'Xóa',
                'edit'            => 'Chỉnh sửa',
                'download'        => 'Tải xuống',
                'destroy-success' => 'Báo giá đã được xóa thành công.',
                'empty-title'     => 'Không tìm thấy báo giá',
                'empty-info'      => 'Không tìm thấy báo giá cho khách hàng tiềm năng này',
                'add-btn'         => 'Thêm báo giá',
            ],

            'products' => [
                'product-name' => 'Tên sản phẩm',
                'quantity'     => 'Số lượng',
                'price'        => 'Giá',
                'amount'       => 'Số tiền',
                'action'       => 'Hành động',
                'add-more'     => 'Thêm nhiều',
                'total'        => 'Tổng',
                'empty-title'  => 'Không tìm thấy sản phẩm',
                'empty-info'   => 'Không tìm thấy sản phẩm cho khách hàng tiềm năng này',
                'add-product'  => 'Thêm sản phẩm',
            ],

            'persons' => [
                'title'     => 'Thông tin về người liên hệ',
                'job-title' => ':job_title tại :organization',
            ],

            'stages' => [
                'won-lost'       => 'Thắng/Thua',
                'won'            => 'Thắng',
                'lost'           => 'Thua',
                'need-more-info' => 'Cần thêm thông tin',
                'closed-at'      => 'Đóng vào',
                'won-value'      => 'Giá trị thắng',
                'lost-reason'    => 'Lý do thua',
                'save-btn'       => 'Lưu',
            ],

            'tags' => [
                'create-success'  => 'Thẻ đã được tạo thành công.',
                'destroy-success' => 'Thẻ đã được xóa thành công.',
            ],
        ],
    ],

    'customers' => [
        'create-success'    => 'Khách hàng hiện hữu đã được tạo thành công.',
        'update-success'    => 'Khách hàng hiện hữu đã được cập nhật thành công.',
        'destroy-success'   => 'Khách hàng hiện hữu đã được xóa thành công.',
        'destroy-failed'    => 'Khách hàng hiện hữu không thể bị xóa.',

        'index' => [
            'title'      => 'Khách hàng hiện hữu',
            'customer'   => 'Khách hàng hiện hữu',
            'create-btn' => 'Tạo khách hàng hiện hữu',

            'datagrid' => [
                'id'                  => 'ID',
                'code'                => 'Mã khách hàng',
                'sales-person'        => 'Nhân viên bán hàng',
                'subject'             => 'Tên khách hàng',
                'source'              => 'Nguồn',
                'lead-value'          => 'Giá trị khách hàng',
                // 'lead-type'           => 'Loại khách hàng',
                'lead-type'           => 'Chi nhánh',
                'tag-name'            => 'Tên thẻ',
                'contact-person'      => 'Người liên hệ',
                'stage'               => 'Giai đoạn',
                'rotten-lead'         => 'Khách hàng hiện hữu đã hỏng',
                'expected-close-date' => 'Ngày đóng dự kiến',
                'created-at'          => 'Ngày tạo',
                'no'                  => 'Không',
                'yes'                 => 'Có',
                'delete'              => 'Xóa',
                'mass-delete'         => 'Xóa hàng loạt',
                'mass-update'         => 'Cập nhật hàng loạt',
                'address'             => 'Địa chỉ',
                'contact-number'      => 'Số điện thoại',
            ],

            'kanban' => [
                'rotten-days'            => 'Khách hàng hiện hữu đã hỏng trong :days ngày',
                'empty-list'             => 'Danh sách khách hàng hiện hữu của bạn trống',
                'empty-list-description' => 'Tạo một khách hàng hiện hữu để tổ chức các mục tiêu của bạn.',
                'create-lead-btn'        => 'Tạo khách hàng hiện hữu',

                'columns' => [
                    'contact-person'      => 'Người liên hệ',
                    'id'                  => 'ID',
                    // 'lead-type'           => 'Loại khách hàng hiện hữu',
                    'lead-type'           => 'Chi nhánh',
                    'lead-value'          => 'Giá trị khách hàng hiện hữu',
                    'sales-person'        => 'Nhân viên bán hàng',
                    'source'              => 'Nguồn',
                    'title'               => 'Tiêu đề',
                    'tags'                => 'Thẻ',
                    'expected-close-date' => 'Ngày đóng dự kiến',
                    'created-at'          => 'Ngày tạo',
                ],

                'toolbar' => [
                    'search' => [
                        'title' => 'Tìm kiếm',
                    ],

                    'filters' => [
                        'apply-filters' => 'Áp dụng bộ lọc',
                        'clear-all'     => 'Xóa tất cả',
                        'filter'        => 'Bộ lọc',
                        'filters'       => 'Các bộ lọc',
                        'select'        => 'Chọn',
                    ],
                ],
            ],

            'view-switcher' => [
                'all-pipelines'       => 'Tất cả các đường ống',
                'create-new-pipeline' => 'Tạo đường ống mới',
            ],
        ],

        'create' => [
            'title'          => 'Tạo khách hàng hiện hữu',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của khách hàng hiện hữu',
            'contact-person' => 'Người liên hệ',
            'contact-info'   => 'Thông tin về người liên hệ',
            'products'       => 'Sản phẩm',
            'products-info'  => 'Thông tin về sản phẩm',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa khách hàng hiện hữu',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của khách hàng hiện hữu',
            'contact-person' => 'Người liên hệ',
            'contact-info'   => 'Thông tin về người liên hệ',
            'products'       => 'Sản phẩm',
            'products-info'  => 'Thông tin về sản phẩm',
        ],

        'common' => [
            'contact' => [
                'name'           => 'Tên',
                'email'          => 'Email',
                'contact-number' => 'Số điện thoại',
                'organization'   => 'Tổ chức',
            ],

            'products' => [
                'product-name' => 'Tên sản phẩm',
                'quantity'     => 'Số lượng',
                'price'        => 'Giá',
                'amount'       => 'Số tiền',
                'action'       => 'Hành động',
                'add-more'     => 'Thêm nhiều',
                'total'        => 'Tổng',
            ],
        ],

        'view' => [
            'title'       => 'Khách hàng hiện hữu: :title',
            'rotten-days' => ':days Ngày',

            'tabs'        => [
                'description' => 'Mô tả',
                'products'    => 'Sản phẩm',
                'quotes'      => 'Báo giá',
            ],

            'attributes' => [
                'title' => 'Thông tin về khách hàng hiện hữu',
            ],

            'quotes'=> [
                'subject'         => 'Chủ đề',
                'expired-at'      => 'Hết hạn vào',
                'sub-total'       => 'Tổng phụ',
                'discount'        => 'Giảm giá',
                'tax'             => 'Thuế',
                'adjustment'      => 'Điều chỉnh',
                'grand-total'     => 'Tổng cộng',
                'delete'          => 'Xóa',
                'edit'            => 'Chỉnh sửa',
                'download'        => 'Tải xuống',
                'destroy-success' => 'Báo giá đã được xóa thành công.',
                'empty-title'     => 'Không tìm thấy báo giá',
                'empty-info'      => 'Không tìm thấy báo giá cho khách hàng hiện hữu này',
                'add-btn'         => 'Thêm báo giá',
            ],

            'products' => [
                'product-name' => 'Tên sản phẩm',
                'quantity'     => 'Số lượng',
                'price'        => 'Giá',
                'amount'       => 'Số tiền',
                'action'       => 'Hành động',
                'add-more'     => 'Thêm nhiều',
                'total'        => 'Tổng',
                'empty-title'  => 'Không tìm thấy sản phẩm',
                'empty-info'   => 'Không tìm thấy sản phẩm cho khách hàng hiện hữu này',
                'add-product'  => 'Thêm sản phẩm',
            ],

            'persons' => [
                'title'     => 'Thông tin về người liên hệ',
                'job-title' => ':job_title tại :organization',
            ],

            'stages' => [
                'won-lost'       => 'Thắng/Thua',
                'won'            => 'Thắng',
                'lost'           => 'Thua',
                'need-more-info' => 'Cần thêm thông tin',
                'closed-at'      => 'Đóng vào',
                'won-value'      => 'Giá trị thắng',
                'lost-reason'    => 'Lý do thua',
                'save-btn'       => 'Lưu',
            ],

            'tags' => [
                'create-success'  => 'Thẻ đã được tạo thành công.',
                'destroy-success' => 'Thẻ đã được xóa thành công.',
            ],
        ],
    ],

    'configuration' => [
        'index' => [
            'back'         => 'Quay lại',
            'save-btn'     => 'Lưu cấu hình',
            'save-success' => 'Cấu hình đã được lưu thành công.',
            'search'       => 'Tìm kiếm',
            'title'        => 'Cấu hình',

            'general'  => [
                'title'   => 'Chung',
                'info'    => 'Cấu hình chung',

                'general' => [
                    'title'           => 'Chung',
                    'info'            => 'Cập nhật cài đặt chung của bạn tại đây.',
                    'locale-settings' => [
                        'title'       => 'Cài đặt ngôn ngữ',
                        'title-info'  => 'Xác định ngôn ngữ sử dụng trong giao diện người dùng, chẳng hạn như tiếng Anh (en), tiếng Pháp (fr), hoặc tiếng Nhật (ja).',
                    ],
                ],
            ],
        ],
    ],


    'dashboard' => [
        'index' => [
            'title' => 'Bảng điều khiển',

            'revenue' => [
                'lost-revenue' => 'Doanh thu mất',
                'won-revenue'  => 'Doanh thu thắng',
            ],

            'over-all' => [
                'average-lead-value'    => 'Giá trị khách hàng tiềm năng trung bình',
                'total-leads'           => 'Tổng số khách hàng tiềm năng',
                'average-leads-per-day' => 'Số khách hàng tiềm năng trung bình mỗi ngày',
                'total-quotations'      => 'Tổng số báo giá',
                'total-persons'         => 'Tổng số người liên hệ',
                'total-organizations'   => 'Tổng số tổ chức',
            ],

            'total-leads' => [
                'title' => 'Khách hàng tiềm năng',
                'total' => 'Tổng số khách hàng tiềm năng',
                'won'   => 'Khách hàng tiềm năng thắng',
                'lost'  => 'Khách hàng tiềm năng thua',
            ],

            'revenue-by-sources' => [
                'title'       => 'Doanh thu theo nguồn',
                'empty-title' => 'Không có dữ liệu',
                'empty-info'  => 'Không có dữ liệu cho khoảng thời gian đã chọn',
            ],

            'revenue-by-types' => [
                'title'       => 'Doanh thu theo loại',
                'empty-title' => 'Không có dữ liệu',
                'empty-info'  => 'Không có dữ liệu cho khoảng thời gian đã chọn',
            ],

            'top-selling-products' => [
                'title'       => 'Sản phẩm bán chạy nhất',
                'empty-title' => 'Không tìm thấy sản phẩm',
                'empty-info'  => 'Không có sản phẩm nào cho khoảng thời gian đã chọn',
            ],

            'top-persons' => [
                'title'       => 'Người liên hệ hàng đầu',
                'empty-title' => 'Không tìm thấy người liên hệ',
                'empty-info'  => 'Không có người liên hệ nào cho khoảng thời gian đã chọn',
            ],

            'open-leads-by-states' => [
                'title'       => 'Khách hàng tiềm năng mở theo trạng thái',
                'empty-title' => 'Không có dữ liệu',
                'empty-info'  => 'Không có dữ liệu cho khoảng thời gian đã chọn',
            ],
        ],
    ],

    'layouts' => [
        'app-version'          => 'Phiên bản : :version',
        'dashboard'            => 'Bảng điều khiển',
        'leads'                => 'Khách hàng tiềm năng',
        'customers'            => 'Khách hàng hiện hữu',
        'quotes'               => 'Báo giá',
        'quote'                => 'Báo giá',
        'mail'                 => [
            'title'   => 'Thư',
            'compose' => 'Soạn thư',
            'inbox'   => 'Hộp đến',
            'draft'   => 'Nháp',
            'outbox'  => 'Hộp đi',
            'sent'    => 'Đã gửi',
            'trash'   => 'Thùng rác',
            'setting' => 'Cài đặt',
        ],
        'activities'           => 'Hoạt động',
        'contacts'             => 'Danh bạ',
        'persons'              => 'Người liên hệ',
        'person'               => 'Người liên hệ',
        'organizations'        => 'Tổ chức',
        'organization'         => 'Tổ chức',
        'products'             => 'Sản phẩm',
        'product'              => 'Sản phẩm',
        'settings'             => 'Cài đặt',
        'user'                 => 'Người dùng',
        'user-info'            => 'Quản lý tất cả người dùng và quyền của họ trong CRM, những gì họ được phép làm.',
        'groups'               => 'Nhóm',
        'groups-info'          => 'Thêm, chỉnh sửa hoặc xóa nhóm từ CRM',
        'roles'                => 'Vai trò',
        'role'                 => 'Vai trò',
        'roles-info'           => 'Thêm, chỉnh sửa hoặc xóa vai trò từ CRM',
        'users'                => 'Người dùng',
        'users-info'           => 'Thêm, chỉnh sửa hoặc xóa người dùng từ CRM',
        'lead'                 => 'Khách hàng tiềm năng',
        'lead-info'            => 'Quản lý tất cả cài đặt liên quan đến khách hàng tiềm năng trong CRM',
        'pipelines'            => 'Dòng doanh thu',
        'pipelines-info'       => 'Thêm, chỉnh sửa hoặc xóa dòng doanh thu từ CRM',
        'sources'              => 'Nguồn',
        'sources-info'         => 'Thêm, chỉnh sửa hoặc xóa nguồn từ CRM',
        'types'                => 'Loại',
        'types-info'           => 'Thêm, chỉnh sửa hoặc xóa loại từ CRM',
        'automation'           => 'Tự động hóa',
        'automation-info'      => 'Quản lý tất cả cài đặt liên quan đến tự động hóa trong CRM',
        'attributes'           => 'Thuộc tính',
        'attribute'            => 'Thuộc tính',
        'attributes-info'      => 'Thêm, chỉnh sửa hoặc xóa thuộc tính từ CRM',
        'email-templates'      => 'Mẫu Email',
        'email'                => 'Email',
        'email-templates-info' => 'Thêm, chỉnh sửa hoặc xóa mẫu email từ CRM',
        'workflows'            => 'Quy trình làm việc',
        'workflows-info'       => 'Thêm, chỉnh sửa hoặc xóa quy trình làm việc từ CRM',
        'other-settings'       => 'Cài đặt khác',
        'other-settings-info'  => 'Quản lý tất cả cài đặt bổ sung trong CRM',
        'tags'                 => 'Thẻ',
        'tags-info'            => 'Thêm, chỉnh sửa hoặc xóa thẻ từ CRM',
        'my-account'           => 'Tài khoản của tôi',
        'sign-out'             => 'Đăng xuất',
        'back'                 => 'Quay lại',
        'name'                 => 'Tên',
        'configuration'        => 'Cấu hình',
        'activities'           => 'Hoạt động',
        'howdy'                => 'Chào bạn!',
        'warehouses'           => 'Kho hàng',
        'warehouse'            => 'Kho hàng',
        'warehouses-info'      => 'Thêm, chỉnh sửa hoặc xóa kho hàng từ CRM',
    ],

    'user' => [
        'account' => [
            'name'                  => 'Tên',
            'email'                 => 'Email',
            'password'              => 'Mật khẩu',
            'my_account'            => 'Tài khoản của tôi',
            'update_details'        => 'Cập nhật chi tiết',
            'current_password'      => 'Mật khẩu hiện tại',
            'confirm_password'      => 'Xác nhận mật khẩu',
            'password-match'        => 'Mật khẩu hiện tại không khớp.',
            'account-save'          => 'Thay đổi tài khoản đã được lưu thành công.',
            'permission-denied'     => 'Quyền truy cập bị từ chối',
            'remove-image'          => 'Xóa hình ảnh',
            'upload_image_pix'      => 'Tải lên hình ảnh hồ sơ (100px x 100px)',
            'upload_image_format'   => 'định dạng PNG hoặc JPG',
            'image_upload_message'  => 'Chỉ cho phép hình ảnh (.jpeg, .jpg, .png, ..).',
        ],
    ],

    'emails' => [
        'common' => [
            'dear'   => 'Kính gửi :name',
            'cheers' => 'Trân trọng,</br>Đội ngũ :app_name',

            'user'   => [
                'dear'           => 'Kính gửi :username',
                'create-subject' => 'Bạn đã được thêm vào làm thành viên.',
                'create-body'    => 'Chúc mừng! Bạn hiện là thành viên của đội ngũ chúng tôi.',

                'forget-password' => [
                    'subject'           => 'Khách hàng Đặt lại Mật khẩu',
                    'dear'              => 'Kính gửi :username',
                    'reset-password'    => 'Đặt lại Mật khẩu',
                    'info'              => 'Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn',
                    'final-summary'     => 'Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào',
                    'thanks'            => 'Cảm ơn!',
                ],
            ],
        ],
    ],

    'errors' => [
        '401' => 'Bạn không được phép truy cập trang này',
    ],

    'zalo' => [
        'title' => 'Zalo',
        'template_title' => 'Zalo - Tin nhắn mẫu',
        'template_detail' => 'Zalo - Chi tiết tin nhắn mẫu',
        'template' => 'Tin nhắn mẫu',
        'columns' => [
            'id' => 'Id',
            'template_id' => 'ID template',
            'template_name' => 'Tên template',
            'status' => 'Trạng thái',
            'price' => 'Giá',
            'template_quality' => 'Chất lượng gửi ',
            'template_tag' => 'Loại nội dung',
        ],
        'button' => [
            'sync_template_from_zalo' => 'Lấy mẫu tin nhắn từ zalo OA',
        ],
        'sync_template_from_zalo_mes' => 'Vui lòng chờ hệ thống xử lý đồng bộ tin nhắn mẫu từ Zalo'
    ],
    'campaign' => [
        'create-success'    => 'Chiến dịch đã được tạo thành công.',
        'create-failed'    => 'Thêm mới Chiến dịch không thành công.',
        'update-success'    => 'Chiến dịch đã được cập nhật thành công.',
        'destroy-success'   => 'Chiến dịch đã được xóa thành công.',
        'destroy-failed'    => 'Chiến dịch không thể bị xóa.',
        'no-result-found'   => 'Không tìm thấy kết quả',
        'index' => [
            'title'      => 'Chiến dịch',
            'list'       => 'Danh sách chiến dịch',
            'create-btn' => 'Tạo Chiến dịch',
            'datagrid' => [
                'id'          => 'ID',
                'name'        => 'Tên chiến dịch',
                'description' => 'Mô tả',
                'created-at'  => 'Ngày tạo',
                'no'          => 'Không',
                'yes'         => 'Có',
                'delete'      => 'Xóa',
                'mass-delete' => 'Xóa hàng loạt',
                'mass-update' => 'Cập nhật hàng loạt',
                'customer'    => 'Khách hàng',
                'schedule'    => 'Lịch trình',
                'status'      => 'Trạng thái',
            ],
        ],

        'create' => [
            'title'          => 'Tạo chiến dịch',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của chiến dịch',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa chiến dịch',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của chiến dịch',
        ],

        'view' => [
            'title' => 'Chi tiết chiến dịch',
        ],
        'common' => [
            'add-more' => 'Thêm nhiều',
            'number' => 'Số thứ tự',
            'date-time' => 'Ngày, giờ',
            'template' => 'Mẫu tin nhắn',
            'select-template' => 'Chọn mẫu tin nhắn',
            'params' => 'Giá trị',
        ],
    ],

    'project' => [
        'title' => 'Dự án',
        'list' => 'Danh sách Dự án',
        'phase_title' => 'Giai đoạn',
        'columns' => [
            'id' => 'Id',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'leader_id' => 'Leader',
            'member_id' => 'Thành viên',
            'member' => 'Thành viên',
        ],
        'button' => [
//            'add_new' => 'Tạo mới dự án',
        ],

        'create-success'    => 'Dự án đã được tạo thành công.',
        'create-failed'     => 'Thêm mới Dự án không thành công.',
        'update-success'    => 'Dự án đã được cập nhật thành công.',
        'update-failed'     => 'Dự án cập nhật không thành công.',
        'destroy-success'   => 'Dự án đã được xóa thành công.',
        'destroy-failed'    => 'Dự án không thể bị xóa.',
        'not-found'         => 'Không tìm thấy dự án',
        'no-result-found'   => 'Không tìm thấy kết quả',
        'index' => [
            'title'      => 'Dự án',
            'list'       => 'Danh sách Dự án',
            'create-btn' => 'Tạo Dự án',
            'datagrid' => [
                'id'          => 'ID',
                'title'       => 'Tiêu đề Dự án',
                'description' => 'Mô tả',
                'leader'      => 'Quản lý',
                'member'      => 'Thành viên',
                'created-at'  => 'Ngày tạo',
                'no'          => 'Không',
                'yes'         => 'Có',
                'delete'      => 'Xóa',
                'mass-delete' => 'Xóa hàng loạt',
                'mass-update' => 'Cập nhật hàng loạt',
                'status'      => 'Trạng thái',
            ],
        ],

        'create' => [
            'title'          => 'Tạo dự án',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của dự án',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa dự án',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của dự án',
        ],

        'view' => [
            'title' => 'Chi tiết dự án',
        ],
    ],
    'phase' => [
        'title' => 'Giai đoạn',
        'list' => 'Danh sách Giai đoạn',
        'phase_title' => 'Giai đoạn',
        'columns' => [
            'id' => 'Id',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'project_id' => 'Dự án',
        ],
        'button' => [
//            'add_new' => 'Tạo mới Giai đoạn',
        ],

        'create-success'    => 'Giai đoạn đã được tạo thành công.',
        'create-failed'     => 'Thêm mới Giai đoạn không thành công.',
        'update-success'    => 'Giai đoạn đã được cập nhật thành công.',
        'update-failed'     => 'Giai đoạn cập nhật không thành công.',
        'destroy-success'   => 'Giai đoạn đã được xóa thành công.',
        'destroy-failed'    => 'Giai đoạn không thể bị xóa.',
        'not-found'         => 'Không tìm thấy Giai đoạn',
        'no-result-found'   => 'Không tìm thấy kết quả',
        'index' => [
            'title'      => 'Giai đoạn',
            'list'       => 'Danh sách Giai đoạn',
            'create-btn' => 'Tạo Giai đoạn',
            'datagrid' => [
                'id'          => 'ID',
                'title'       => 'Tiêu đề Giai đoạn',
                'description' => 'Mô tả',
                'start_date'  => 'Ngày bắt đầu',
                'end_date'    => 'Ngày kết thúc',
                'project'     => 'Dự án',
                'created-at'  => 'Ngày tạo',
                'no'          => 'Không',
                'yes'         => 'Có',
                'delete'      => 'Xóa',
                'mass-delete' => 'Xóa hàng loạt',
                'mass-update' => 'Cập nhật hàng loạt',
                'status'      => 'Trạng thái',
            ],
        ],

        'create' => [
            'title'          => 'Tạo Giai đoạn',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của Giai đoạn',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa Giai đoạn',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của Giai đoạn',
        ],

        'view' => [
            'title' => 'Chi tiết Giai đoạn',
        ],
    ],

    'task' => [
        'title' => 'Task',
        'list' => 'Danh sách Task',
        'phase_title' => 'Giai đoạn',
        'columns' => [
            'id' => 'Id',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'step' => 'Bước',
            'status' => 'Trạng thái',
            'priority' => 'Uu tiên',
            'assignee' => 'Người thực hiện',
            'project' => 'Dự án',
            'phase' => 'Giai đoạn',
            'task' => 'Task',
            'sub_task' => 'Subtask'
        ],
        'button' => [
//            'add_new' => 'Tạo mới Task',
        ],

        'create-success'    => 'Task đã được tạo thành công.',
        'create-failed'     => 'Thêm mới Task không thành công.',
        'update-success'    => 'Task đã được cập nhật thành công.',
        'update-failed'     => 'Task cập nhật không thành công.',
        'destroy-success'   => 'Task đã được xóa thành công.',
        'destroy-failed'    => 'Task không thể bị xóa.',
        'not-found'         => 'Không tìm thấy Task',
        'no-result-found'   => 'Không tìm thấy kết quả',
        'index' => [
            'title'      => 'Task',
            'list'       => 'Danh sách Task',
            'create-btn' => 'Tạo Task',
            'datagrid' => [
                'id'          => 'ID',
                'title'       => 'Tiêu đề',
                'description' => 'Mô tả',
                'step'        => 'Bước',
                'priority' => 'Uu tiên',
                'leader' => 'Người điều phối',
                'assignee' => 'Người thực hiện',
                'project' => 'Dự án',
                'phase' => 'Giai đoạn',
                'task' => 'Task',
                'sub_task' => 'Subtask',
                'created-at'  => 'Ngày tạo',
                'start_date'  => 'Ngày bắt đầu',
                'end_date'  => 'Ngày kết thúc',
                'no'          => 'Không',
                'yes'         => 'Có',
                'delete'      => 'Xóa',
                'mass-delete' => 'Xóa hàng loạt',
                'mass-update' => 'Cập nhật hàng loạt',
                'status'      => 'Trạng thái',
            ],
        ],

        'create' => [
            'title'          => 'Tạo Task',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của Task',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa Task',
            'save-btn'       => 'Lưu',
            'details'        => 'Chi tiết',
            'details-info'   => 'Nhập thông tin cơ bản của Task',
        ],

        'view' => [
            'title' => 'Chi tiết Task',
        ],
    ],

];
