<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RecipientResponseDtoShape from \Bila\TransferRecipients\RecipientResponseDto
 *
 * @phpstan-type TransferRecipientNewBankAccountResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: null|RecipientResponseDto|RecipientResponseDtoShape,
 * }
 */
final class TransferRecipientNewBankAccountResponse implements BaseModel
{
    /** @use SdkModel<TransferRecipientNewBankAccountResponseShape> */
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
    public ?RecipientResponseDto $data;

    /**
     * `new TransferRecipientNewBankAccountResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferRecipientNewBankAccountResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferRecipientNewBankAccountResponse)->withMessage(...)->withStatus(...)
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
     * @param RecipientResponseDto|RecipientResponseDtoShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        RecipientResponseDto|array|null $data = null
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
     * @param RecipientResponseDto|RecipientResponseDtoShape $data
     */
    public function withData(RecipientResponseDto|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
