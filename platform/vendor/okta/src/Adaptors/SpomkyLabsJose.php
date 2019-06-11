<?php
/******************************************************************************
 * Copyright 2017 Okta, Inc.                                                  *
 *                                                                            *
 * Licensed under the Apache License, Version 2.0 (the "License");            *
 * you may not use this file except in compliance with the License.           *
 * You may obtain a copy of the License at                                    *
 *                                                                            *
 *      http://www.apache.org/licenses/LICENSE-2.0                            *
 *                                                                            *
 * Unless required by applicable law or agreed to in writing, software        *
 * distributed under the License is distributed on an "AS IS" BASIS,          *
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.   *
 * See the License for the specific language governing permissions and        *
 * limitations under the License.                                             *
 ******************************************************************************/

namespace Okta\JwtVerifier\Adaptors;

use Jose\Loader;
use Okta\JwtVerifier\Jwt;

class SpomkyLabsJose implements Adaptor
{
    public function getKeys($jku)
    {
        return \Jose\Factory\JWKFactory::createFromJKU($jku);
    }

    public function decode($jwt, $keys): Jwt
    {
        $decoded = (new Loader())
            ->loadAndVerifySignatureUsingKeySet(
                $jwt,
                $keys,
                ['RS256'],
                $signature_index
            );

        return (new Jwt($jwt, $decoded->getPayload()));
    }

    public static function isPackageAvailable()
    {
        return
            class_exists(\Jose\Factory\JWKFactory::class) &&
            class_exists(Loader::class);
    }
}