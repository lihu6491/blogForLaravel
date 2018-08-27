<?php
namespace App\Hasher;

use RuntimeException;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class PasswordHasher implements HasherContract
{
    /**
     * @param string $hashedValue
     */
    public function info($hashedValue){
        return $hashedValue;
    }


    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     *
     * @throws \RuntimeException
     */
    public function make($value, array $options = [])
    {
        //加密密码
        $hash = password_hash($value,PASSWORD_BCRYPT);

        if ($hash === false) {
            throw new RuntimeException('base64 hashing not supported.');
        }

        return $hash;
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        //认证密码
        return password_verify($value, $hashedValue);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

}