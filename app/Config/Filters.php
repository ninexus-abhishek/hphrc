<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'auth-customer' => \App\Filters\AuthFilter::class,
		'securityHeaders' => \App\Filters\SecurityHeadersFilter::class,
		'preventConcurrentSSOLogin' => \App\Filters\PreventConcurrentSSOLogin::class,


		'customerCombo' => [
			\App\Filters\AuthFilter::class,
    		\App\Filters\PreventConcurrentSSOLogin::class,
		],
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			'csrf' => [
				'except' => [
					'employee-add-comment',
					'admin-load-sub-categories',
					'front-add-comment',
					'approve-status',
					'employee-update-profile',
					'admin-customer-approve-status',
					'admin-employee-approve-status',
					'admin-active-causes',
					'admin-update-profile',
					'admin-active-category',
					'front-update-profile',
					'update-forget-password',
				],
			],
		],
		'after'  => [
			'securityHeaders',
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
