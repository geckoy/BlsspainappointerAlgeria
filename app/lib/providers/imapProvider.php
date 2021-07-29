<?php
namespace App\lib\providers; // use App\lib\providers\imapProvider;
/**
 * Dependencies
 */
use App\lib\recommendations\imap;

class imapProvider implements imap
{
    /**
     * User Email
     */
    private $email;

    /**
     * user email password 
     */
    private $password;

    /**
     * own mail server
     */
    private $ownmail;

    /**
     * user connection to inbox
     */
    private $connection_inbox;
    
    /**
     * user connection to spam
     */
    private $connection_spam;

    public function setUp_config($ownmail)
    {
        $this->ownmail = $ownmail;
    }

    public function setUp_mailaccount($email, $password)
    {
        $this->email            = $email;
        $this->password         = $password;
        if(preg_match("/@gmail.com/im", $this->email))
        {
            $this->connection_inbox = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", $this->email, $this->password);
            $this->connection_spam  = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}[Gmail]/Spam", $this->email, $this->password);
        }else
        {
            $this->connection_inbox = imap_open("{".$this->ownmail.":993/imap/ssl/novalidate-cert}INBOX", $this->email, $this->password);
            $this->connection_spam  = imap_open("{".$this->ownmail.":993/imap/ssl/novalidate-cert}Junk", $this->email, $this->password);
        }
        
        
        return $this;
    }
    
    public function check_activity($mailbox)
    {
        if($mailbox == "spam")
        {
            $mbox = $this->connection_spam;
        }elseif($mailbox == "inbox")
        {
            $mbox = $this->connection_inbox;
        }else
        {
            return false;
        }

        $MC = imap_check($mbox);
        $result = array_reverse(imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0));
        foreach ($result as $overview) 
        {
            $from = utf8_decode(imap_utf8($overview->from));
                $body = imap_fetchbody($mbox, $overview->msgno,'1'); 
                $date = date("d", strtotime($overview->date));
                
                echo "MESSAGE <br />";
                echo "=============================== <br />";
                echo  $from." ".$date."<br />";
                echo $body;
                echo "<br />";
        }
        imap_close($mbox);
        return false;

    }
    public function check_token()
    {
        $status_inbox = $this->checking( $this->connection_inbox );

        if($status_inbox !== false) return $status_inbox;
        
        $status_spam = $this->checking( $this->connection_spam );

        if($status_spam !== false) return $status_spam;

        return false;
    }


    public function check_otp()
    {
        $status_inbox = $this->checking_otp( $this->connection_inbox );

        if($status_inbox !== false) return $status_inbox;
        
        $status_spam = $this->checking_otp( $this->connection_spam );

        if($status_spam !== false) return $status_spam;

        return false;
    }

    private function checking( $mbox )
    {
        // $mail = imap_search($mbox, "ALL");
        $MC = imap_check($mbox);
        $result = array_reverse(imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0));
        foreach ($result as $overview) 
        {
            $from = utf8_decode(imap_utf8($overview->from));
            if( preg_match( "/BLS SPAIN/i",  $from ) )
            {
                $body = imap_fetchbody($mbox, $overview->msgno,'1'); 
                $date = date("d", strtotime($overview->date));
                
                if( date("d") == $date )
                {
                    if(preg_match("/Verification(.*|)code.*\d+/im", $body, $verification_code))
                    {
                        preg_match("/\d+/im", $verification_code[0], $code);

                        return $code[0];

                            /**
                                 * test
                                 */
                            //  echo "#{$overview->msgno} ({$overview->date}) - From: ".utf8_decode(imap_utf8($overview->from))." subject:
                            //  ".utf8_decode(imap_utf8($overview->subject))." body : ".base64_decode(imap_fetchbody($mbox, $overview->msgno,'1'))."<br/>";
                    }
                }
            }
        }
        imap_close($mbox);
        return false;
    }

    private function checking_otp( $mbox )
    {
        // $mail = imap_search($mbox, "ALL");
        $MC = imap_check($mbox);
        $result = array_reverse(imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0));
        foreach ($result as $overview) 
        {
            $from = utf8_decode(imap_utf8($overview->from));
            if( preg_match( "/BLS SPAIN/i",  $from ) )
            {
                $body = imap_fetchbody($mbox, $overview->msgno,'1'); 
                $date = date("d", strtotime($overview->date));
                
                if( date("d") == $date )
                {
                    if(preg_match("/OTP - \d*/im", $body, $verification_code))
                    {
                        
                   
                        preg_match("/\d+/im", $verification_code[0], $code);

                        return $code[0];

                            /**
                                 * test
                                 */
                            //  echo "#{$overview->msgno} ({$overview->date}) - From: ".utf8_decode(imap_utf8($overview->from))." subject:
                            //  ".utf8_decode(imap_utf8($overview->subject))." body : ".base64_decode(imap_fetchbody($mbox, $overview->msgno,'1'))."<br/>";
                    }
                }
            }
        }
        imap_close($mbox);
        return false;
    }
}