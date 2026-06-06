<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type WebhookConfigResponseDtoShape from \Bila\Webhooks\WebhookConfigResponseDto
 *
 * @phpstan-type WebhookUpdateResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: null|WebhookConfigResponseDto|WebhookConfigResponseDtoShape,
 * }
 */
final class WebhookUpdateResponse implements BaseModel
{
    /** @use SdkModel<WebhookUpdateResponseShape> */
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
    public ?WebhookConfigResponseDto $data;

    /**
     * `new WebhookUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookUpdateResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookUpdateResponse)->withMessage(...)->withStatus(...)
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
     * @param WebhookConfigResponseDto|WebhookConfigResponseDtoShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        WebhookConfigResponseDto|array|null $data = null
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
     * @param WebhookConfigResponseDto|WebhookConfigResponseDtoShape $data
     */
    public function withData(WebhookConfigResponseDto|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
