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
 * @phpstan-type WebhookListResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: list<WebhookConfigResponseDto|WebhookConfigResponseDtoShape>|null,
 * }
 */
final class WebhookListResponse implements BaseModel
{
    /** @use SdkModel<WebhookListResponseShape> */
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

    /** @var list<WebhookConfigResponseDto>|null $data */
    #[Optional(list: WebhookConfigResponseDto::class)]
    public ?array $data;

    /**
     * `new WebhookListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookListResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookListResponse)->withMessage(...)->withStatus(...)
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
     * @param list<WebhookConfigResponseDto|WebhookConfigResponseDtoShape>|null $data
     */
    public static function with(
        string $message,
        bool $status,
        ?array $data = null
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
     * @param list<WebhookConfigResponseDto|WebhookConfigResponseDtoShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
