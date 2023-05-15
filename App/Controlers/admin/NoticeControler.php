<?php

namespace Controler;

use \Controler\AdminControler;


class NoticeControler extends AdminControler {

    public function __construct() {
        parent::__construct();
    }


    public function addNotice() {
        $postData = postDataRetrieve();
        
        $attachments = @$postData['notice_attachment_file'];
        unset($postData['notice_attachment_file']);

        foreach ($postData as $data) {
            if (strlen($data) < 1) {
                return sendJsonError('All fields must be filled out', 403);
            }
        }

        $allowedFileExtensions = [
            'jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx', 'txt'
        ];
        $maxImageSize = 25;

        $attFiles = array();
        if (is_array($attachments)) {     
            foreach($attachments as $key => $file) {
                $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (in_array($fileExt, $allowedFileExtensions)) {
                    $fileData = base64_decode($file['data']);
                    if (strlen($fileData) < 1024 * 1024 * $maxImageSize) {    
                        
                        $save_img_path = __DIR__ .'/../../resources/images/notice';

                        $attFiles[$key] = 'notice_' . uniqid() . '.' . $fileExt;
                        $fileWithDir = $save_img_path . '/' . $attFiles[$key];
        
                        touch($fileWithDir);
                        file_put_contents($fileWithDir, $fileData);            
                        
                    } else {
                        
                        return sendJsonError('Image file size exceed (max ' . $maxImageSize . 'MB)', 403);
        
                    }
                } else {
        
                    return sendJsonError('File Extension Not Allowed', 403);
        
                }
                
            }

        }

        $postData['notice_unique_id'] = uniqid();
        $postData['notice_attachment_file'] = json_encode($attFiles);

        $noticeModel = $this->load->model('NoticeModel');
        if ($noticeModel->insert($postData)) {
            return sendJsonSuccess('Notice Added');
        }

        return sendJsonError('unable to add notice' . $noticeModel->getErrorMessage(), 501);
        
    }

}

