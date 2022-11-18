<?php

/**
 * Abhisinchan_ldap.php
 * Provides an object orientated LDAP wrapper for AD
 * 
 * @author Abhisinchan Ingole < strike at coreone dot in>
 * @version 0.1
 * @copyright Copyright &copy; 2020 Abhisinchan Ingole
 * 
 * This is simply an object orientated wrapper for the PHP LDAP functions to work on AD.
 * 
 * 
 */

class portal_ldap
{
  private $ad_handle;

  private $ldapErrno;
  private $ldapError;

  protected $ldap_dn = 'ou=consultant,dc=metaljunction,dc=com'; // mj consultant
  protected $ldap_dnolu = 'ou=olu,dc=metaljunction,dc=com';

  protected $ldapHost = '172.16.2.5';
  #protected $domain = 'mj';
  protected $domain = 'metaljunction.com';

  // protected $username; //= 'test.user';
  protected $username; //= 'test.user';
  protected $password; //= 'pass@123';
  // protected $password; //= 'pass@123';
  protected $superuser = '';
  protected $superpass = '';
  protected $activeuser = '512';
  protected $inactiveuser = '514';
  protected $accountStatus;
  private $binder;

  function connect()
  {
    $this->ad_handle = ldap_connect($this->ldapHost, 389); //636

    $ldapconn = ldap_connect("172.16.2.5", 389);
    $this->ad_handle = $ldapconn;
     //echo "sdafdsaf";die;
    if ($this->ad_handle) {
       //echo $this->username ."===" .$this->password;die;
      //echo 'connection';
      ldap_set_option($this->ad_handle, LDAP_OPT_PROTOCOL_VERSION, 3);
      ldap_set_option($this->ad_handle, LDAP_OPT_REFERRALS, 0);
      if (strpos($this->username, '@') !== false) {
          $bindUserName = $this->username;
      }
      else {
          $bindUserName = $this->username . "@" . $this->domain;
      }
      $this->binder = @ldap_bind($this->ad_handle, $bindUserName, $this->password);
      //var_dump($this->binder);die;
      return $this->binder;
    }
    return false;
  }



  function userpass_setter($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
    return;
  //echo $this->username." & ".$this->password; exit();
  }

  function host_setter($host)
  {
    $this->ldapHost = $host;
    return;
  //echo $this->username." & ".$this->password; exit();
  }

  function host_getter()
  {
    return $this->ldapHost;
  }

  function getUserArray()
  {
    $filter = "(sAMAccountName=" . $this->username . ")";
    $attributes = array('cn', 'mail', 'sn', 'userAccountControl', 'sAMAccountName');

    //For MJ OU
    $resultMj = ldap_search($this->ad_handle, $this->ldap_dn, $filter, $attributes);
    $entriesMj = ldap_get_entries($this->ad_handle, $resultMj);

    //print_r($entriesMj);
    //For OLU OU
    $resultOLU = ldap_search($this->ad_handle, $this->ldap_dnolu, $filter, $attributes);
    $entriesOLU = ldap_get_entries($this->ad_handle, $resultOLU);
   
    //print_r($entriesOLU);
    if ($entriesMj['count'] > 0) {
      $emailMj = trim($entriesMj[0]['mail'][0]);
      $cnMj = trim($entriesMj[0]['cn'][0]);
      $snMj = trim($entriesMj[0]['sn'][0]);
      $statusMj = trim($entriesMj[0]['useraccountcontrol'][0]);
      $sAMAccountNameMj = trim($entriesMj[0]['samaccountname'][0]);
      $dnMj = trim($entriesMj[0]['dn']);
      $this->accountStatus = $statusMj;
      //return $dnMj;
      return $emailMj;
    }
    if ($entriesOLU['count'] > 0) {
      $emailOLU = trim($entriesOLU[0]['mail'][0]);
      $cnOLU = trim($entriesOLU[0]['cn'][0]);
      $snOLU = trim($entriesOLU[0]['sn'][0]);
      $statusOLU = trim($entriesOLU[0]['useraccountcontrol'][0]);
      $sAMAccountNameOLU = trim($entriesOLU[0]['samaccountname'][0]);
      $dnOLU = trim($entriesOLU[0]['dn']);
      $this->accountStatus = $statusOLU;
      //return $dnOLU;
      return $emailOLU;
    }
  }

  function getAccountStatus()
  {
    if ($this->accountStatus == $this->activeuser)
      return true;
    if ($this->accountStatus == $this->inactiveuser)
      return true;
  }

  function setErrVars()
  {
    $this->ldapErrno = ldap_errno($this->ad_handle);
    $this->ldapError = ldap_error($this->ad_handle);
  }

  function getErrno()
  {
    return $this->ldapErrno;
  }

  function getError()
  {
    return $this->ldapError;
  }

  function close()
  {
    @ldap_close($this->ad_handle);
  }

  function set_password($username, $password)
  {
    $retval = 0;
    $dn = $this->get_ldap_dn($username);

    $newpassword = "$password";
    $newpassword = "\"" . $newpassword . "\"";
    $len = strlen($newpassword);
    for ($i = 0; $i < $len; $i++)
      //$newpass .= "{$newpassword{ $i}}\000";
      $newpass .= "$newpassword[$i]\000";
    $entry["unicodePwd"] = $newpass;

    $logfile = fopen("./passwordchange_log.txt", "a+");
    $logline = date("Y-m-d H:i:s") . " - password for account " . $username . " changed by " . $GLOBALS['REMOTE_USER'] . "\n";
    fwrite($logfile, $logline);
    fclose($logfile);

    if ($this->has_letnet_account) {
      if (ldap_mod_replace($this->ad_handle, $dn, $entry)) {
        $retval = 1;
        print "<p align=\"center\">AD Password change succeeded!</p>";
      }
      else {
        print "<p align=\"center\">AD Password change failed.</p>";
      }
    }
    return ($retval);
  }

}
