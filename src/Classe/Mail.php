<?php


namespace App\Classe;


use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
 private $api_key='76ace0bc37255d06a6e86b9c61f75c9c';
 private $api_key_secret='c3b199f68628886f7716109e597e404a';
 public function send($to_email,$to_name,$subject,$content){
     $mj = new Client($this->api_key,$this->api_key_secret,true,['version' => 'v3.1']);
     $body = [
         'Messages' => [
             [
                 'From' => [
                     'Email' => "ramzi.devweb@gmail.com",
                     'Name' => "REANIME"
                 ],
                 'To' => [
                     [
                         'Email' => $to_email,
                         'Name' => $to_name
                     ]
                 ],
                 'TemplateID' => 2858119,
                 'TemplateLanguage' => true,
                 'Subject' => $subject,
                 'Variables' => [
                     'content' => $content,
                 ]
             ]
         ]
     ];
     $response = $mj->post(Resources::$Email, ['body' => $body]);

 }
}