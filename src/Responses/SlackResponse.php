<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Responses;

use Saloon\Contracts\Response as ResponseContract;
use Saloon\Http\Response;
use Saloon\Traits\Responses\HasResponseHelpers;

class SlackResponse extends Response implements ResponseContract
{
    use HasResponseHelpers;

    public function successful(): bool
    {
        return $this->ok() && $this->json('ok', false) === true;
    }

    public function failed(): bool
    {
        return ! $this->successful();
    }

    public function error(): string
    {
        return $this->json('error');
    }

    public function warning(): string
    {
        return $this->json('warning');
    }

    public function hasWarning(): bool
    {
        return $this->json('warning', false) !== false;
    }

    public function hasError(): bool
    {
        return $this->json('error', false) !== false;
    }
}
