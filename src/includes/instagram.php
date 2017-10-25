<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

class instagramAPI {

    var $insta;

    function __construct($config=null) {
        $this->insta = new \InstagramAPI\Instagram(false, false);
        try {
            $this->insta->login($config['INS_USER_NAME'], $config['INS_USER_PASSWORD']);
        } catch (\Exception $e) {
            return false;
        }
    }

    function uploadPhoto($photoFilename, $captionText = "") {
        try {
            $resizer = new \InstagramAPI\MediaAutoResizer($photoFilename);
            $checkStatus = $this->insta->timeline->uploadPhoto($resizer->getFile(), ['caption' => $captionText]);
            return $checkStatus->getUploadId();
        } catch (\Exception $e) {
            return false;
        }
    }

     function uploadAlbum($photoFilename, $captionText = "") {
        try {
            //$resizer = new \InstagramAPI\MediaAutoResizer($photoFilename);
            $checkStatus = $this->insta->timeline->uploadAlbum($photoFilename, ['caption' => $captionText]);
            $resultData['code'] = $checkStatus->getMedia()->getCode();
            $resultData['id'] = $checkStatus->getMedia()->getId();
            $resultData['username'] = $checkStatus->getMedia()->getUser()->getUsername();
            $resultData['status'] = "success";
            $resultData['message'] = "https://www.instagram.com/p/".$resultData['code']."/?taken-by=".$resultData['username'];
            return $resultData;
        } catch (\Exception $e) {
            $resultData['message'] = $e->getMessage();
            $resultData['status'] = "failure";
            return $resultData;
        }
    }

    function userFeeds() {
        try {
            $userId = $this->insta->people->getUserIdForName(INS_USER_NAME);
            $resultData = [];
            $maxId = null;
            do {
                // Request the page corresponding to maxId.
                $response = $this->insta->timeline->getUserFeed($userId, $maxId);
                // In this example we're simply printing the IDs of this page's items.
                foreach ($response->getItems() as $key => $item) {
                    $resultData[$key]['pk'] = $item->getPk();
                    $resultData[$key]['id'] = $item->getId();
                    $resultData[$key]['code'] = $item->getCode();
                    $resultData[$key]['taken_at'] = $item->getTakenAt();
                    $resultData[$key]['device_timestamp'] = $item->getDeviceTimestamp();
                    $resultData[$key]['caption']['status'] = $item->getCaption()->getStatus();
                    $resultData[$key]['caption']['user_id'] = $item->getCaption()->getUserId();
                    $resultData[$key]['caption']['item_text'] = $item->getCaption()->getText();
                    $resultData[$key]['username'] = $item->getUser()->getFullName();
                    $resultData[$key]['profile_pic_url'] = $item->getUser()->getProfilePicUrl();
                    //$resultData[$key]['text_image'] = $item->getImageVersions2()->getCandidates()[1]->getUrl();
                }
                $maxId = $response->getNextMaxId();
                //sleep(5);
            } while ($maxId !== null); // Must use "!==" for comparison instead of "!=
            return $resultData;
        } catch (\Exception $e) {
            return false;
        }
    }

}
