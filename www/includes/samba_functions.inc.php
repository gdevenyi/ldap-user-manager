<?php

function samba_hash($password) {
  // NTLMv2 hash
  $password = iconv('UTF-8', 'UTF-16LE', $password);
  $ntlm_hash = strtoupper(hash('md4', $password));  
  return($ntlm_hash);
}

function samba_get_domain_sid($ldap_connection) {

  global $log_prefix, $LDAP;
  
  $filter = "(&(objectclass=sambaDomain))";
  $ldap_search = @ ldap_search($ldap_connection, "${LDAP['base_dn']}", $filter, array('sambaSID'));
  $result = ldap_get_entries($ldap_connection, $ldap_search);

  if (isset($result[0]['sambaSID'][0])) {
    return $result[0]['sambaSID'][0];
  }
  else {
    error_log("$log_prefix samba domain not found.",0);
    return "";
  }
}

?>