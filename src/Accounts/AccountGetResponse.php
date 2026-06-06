<?php

declare(strict_types=1);

namespace Bila\Accounts;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AccountResponseDtoShape from \Bila\Accounts\AccountResponseDto
 *
 * @phpstan-type AccountGetResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: null|AccountResponseDto|AccountResponseDtoShape,
 * }
 */
final class AccountGetResponse implements BaseModel
{
    /** @use SdkModel<AccountGetResponseShape> */
    use SdkModel;

    /**
     * Response message.
     */
    #[Required]
    public string $message;

    /**
     * Request success status.
     */
    #[Required]
    public bool $status;

    #[Optional]
    public ?AccountResponseDto $data;

    /**
     * `new AccountGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountGetResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountGetResponse)->withMessage(...)->withStatus(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AccountResponseDto|AccountResponseDtoShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        AccountResponseDto|array|null $data = null
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['status'] = $status;

        null !== $data && $self['data'] = $data;

        return $self;
    }

    /**
     * Response message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Request success status.
     */
    public function withStatus(bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param AccountResponseDto|AccountResponseDtoShape $data
     */
    public function withData(AccountResponseDto|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
