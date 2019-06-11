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

namespace Okta\JwtVerifier;

use Okta\JwtVerifier\Adaptors\Adaptor;
use Okta\JwtVerifier\Discovery\DiscoveryMethod;
use Okta\JwtVerifier\Discovery\Oauth;

class JwtVerifierBuilder
{
    protected $issuer;
    protected $discovery;
    protected $request;
    protected $adaptor;
    protected $audience;
    protected $clientId;
    protected $nonce;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    /**
     * Sets the issuer URI.
     *
     * @param string $issuer The issuer URI
     * @return JwtVerifierBuilder
     */
    public function setIssuer(string $issuer): self
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Set the Discovery class. This class should be an instance of DiscoveryMethod.
     *
     * @param DiscoveryMethod $discoveryMethod The DiscoveryMethod instance.
     * @return JwtVerifierBuilder
     */
    public function setDiscovery(DiscoveryMethod $discoveryMethod): self
    {
        $this->discovery = $discoveryMethod;

        return $this;
    }

    /**
     * Set the Adaptor class. This class should be an interface of Adaptor.
     *
     * @param Adaptor $adaptor The adaptor of the JWT library you are using.
     * @return JwtVerifierBuilder
     */
    public function setAdaptor(Adaptor $adaptor): self
    {
        $this->adaptor = $adaptor;

        return $this;
    }

    public function setAudience($audience)
    {
        $this->audience = $audience;

        return $this;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function setNonce($nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * Build and return the JwtVerifier.
     *
     * @throws \InvalidArgumentException
     * @return JwtVerifier
     */
    public function build(): JwtVerifier
    {
        if (null === $this->issuer) {
            throw new \InvalidArgumentException('You must supply an issuer');
        }

        return new JwtVerifier(
            $this->issuer,
            $this->discovery,
            $this->adaptor,
            $this->request,
            [
                'nonce' => $this->nonce,
                'audience' => $this->audience,
                'clientId' => $this->clientId
            ]
        );
    }
}
