<?php

class Config {
  public static function DB_HOST(){
      return Config::get_env("DB_HOST", "localhost");
    }
    public static function DB_USERNAME(){
      return Config::get_env("DB_USERNAME", "root");
    }
    public static function DB_PASSWORD(){
      return Config::get_env("DB_PASSWORD", "rootroot");
    }
    public static function DB_SCHEME(){
      return Config::get_env("DB_SCHEME", "clothing-website");
    }
    public static function DB_PORT(){
      return Config::get_env("DB_PORT", "3306");
    }

  const SMTP_HOST = "smtp.gmail.com";
  const SMTP_PORT = 587;
  const SMTP_ENCRYPT = "tls";
  const SMTP_USER = "matej.mujezinovic@gmail.com";
  const SMTP_PASSWORD = "margo4444";

  const DATE_FORMAT= "Y-m-d H:i:s";

  const JWT_SECRET="7hs9cDoesadjf92c2%2c3";

  const JWT_TOKEN_TIME=604800;

  public static function get_env($name, $default){
  return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
}
}

?>
