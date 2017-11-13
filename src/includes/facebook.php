<?php

//https://stackoverflow.com/questions/23015640/how-do-i-can-post-a-multiple-photos-via-facebook-api
require_once 'vendor/autoload.php';

class facebookApi {

    var $fb;

    function __construct() {
        $this->fb = new \Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v2.10',
                //'default_access_token' => FB_ACCESS_TOKEN, // optional
        ]);
    }

    function getUserDetails($accessToken) {
        try {
            $response = $this->fb->get('/me', $accessToken);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return false;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return false;
        }
        $me = $response->getGraphUser();
        return $me;
    }

    function uploadPhoto($accessToken, $photoFilename, $captionText = "") {
        $data = [
            //'message' => $captionText,
            'source' => $this->fb->fileToUpload($photoFilename),
            'published' => false
        ];
        try {
            $response = $this->fb->post('/me/photos', $data, $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo 'Graph returned an error: ' . $e->getMessage();
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $graphNode = $response->getGraphNode();
        if(!empty($graphNode['id'])) {
            return $graphNode['id'];
        } else {
            return false;
        }
    }

    function uploadTimeline($accessToken, $data) {
        /*$data = [
            'message' => $captionText,
            'attached_media[0]' => '{"media_fbid":"2117955968229888"}',
            'attached_media[1]' => '{"media_fbid":"2117956374896514"}'
        ];*/
        try {
            $response = $this->fb->post('/me/feed', $data, $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo 'Graph returned an error: ' . $e->getMessage();
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $graphNode = $response->getGraphNode();
        if(!empty($graphNode['id'])) {
            return $graphNode['id'];
        } else {
            return false;
        }
    }

    function getPost($accessToken, $postId = null) {
        try {
            $response = $this->fb->get('/' . $postId, $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo 'Graph returned an error: ' . $e->getMessage();
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $graphNode = $response->getGraphObject();
        return $graphNode;
    }

    function updatePost($accessToken, $postId = null, $message = "") {
        try {
            $data = [
                'message' => $message
            ];
            $response = $this->fb->post('/' . $postId, $data, $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo 'Graph returned an error: ' . $e->getMessage();
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $graphNode = $response->getGraphObject();
        return $graphNode;
    }

    function deletePost($accessToken, $postId = null) {
        try {
            $response = $this->fb->delete('/' . $postId, array(), $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo 'Graph returned an error: ' . $e->getMessage();
            return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $graphNode = $response->getGraphObject();
        return $graphNode;
    }

    function exchangedAccessToken($accessToken) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id=".FB_APP_ID."&client_secret=".FB_APP_SECRET."&grant_type=fb_exchange_token&fb_exchange_token=".$accessToken."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        $accessToken = json_decode($result, true);
        if(!empty($accessToken['access_token'])) {
            return $accessToken['access_token'];
        } else {
            return false;
        }
    }
}
