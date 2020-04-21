<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Teknasyon\HuaweiMobileService;

/**
 * The Google API Client
 * https://github.com/google/google-api-php-client
 */
class HuaweiClient extends \Google_Client
{
  const LIBVER = "2.4.1";
  const USER_AGENT_SUFFIX = "google-api-php-client/";
  const OAUTH2_REVOKE_URI = 'https://oauth2.googleapis.com/revoke';
  const OAUTH2_TOKEN_URI = 'https://oauth-login.cloud.huawei.com/oauth2/v2/token';
  const OAUTH2_AUTH_URL = 'https://oauth-login.cloud.huawei.com/oauth2/v2/authorize';
  const API_BASE_PATH = 'https://www.googleapis.com';

}
