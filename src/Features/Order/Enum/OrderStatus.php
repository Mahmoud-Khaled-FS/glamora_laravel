<?php

namespace Src\Features\Order\Enum;

enum OrderStatus: string
{
  case PENDING = 'pending';
  case ACCEPTED = 'accepted';
  case DELIVERED = 'delivered';
  case CANCELLED = 'cancelled';
}
