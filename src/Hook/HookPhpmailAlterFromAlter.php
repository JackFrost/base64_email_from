<?php

namespace Drupal\base64_email_from\Hook;

/**
 * HookPhpmailAlterFromAlter.
 */
class HookPhpmailAlterFromAlter {

  /**
   * Hook.
   */
  public static function hook(&$mail) {
    $mail = self::getBase64EncodedEmailLine($mail);
  }

  /**
   * Encode email.
   */
  private static function getBase64EncodedEmailLine(
    string $emailLine
  ) : string {
    $pattern = '/^([\s\S]*)\s\<([\s\S]*)\>$/';
    if (!preg_match_all($pattern, $emailLine, $matches)) {
      return $emailLine;
    }
    $name = array_shift($matches[1]);
    $email = array_shift($matches[2]);
    return sprintf('=?utf-8?b?%s?= <%s>', base64_encode($name), $email);
  }

}
