<?php

namespace Message\Mothership\FileManager\Bootstrap;

use Message\Cog\Bootstrap\ServicesInterface;

class Services implements ServicesInterface
{
	public function registerServices($serviceContainer)
	{
		$serviceContainer['filesystem.stream_wrapper_mapping'] = $serviceContainer->extend('filesystem.stream_wrapper_mapping', function($mapping, $serviceContainer) {
			$baseDir = $serviceContainer['app.loader']->getBaseDir();
			// Maps cog://ms/file/* to /files/* (in the installation)
			$mapping["/^\/ms\/file\/(.*)/us"] = $baseDir.'files/$1';

			return $mapping;
		});

		$serviceContainer['filesystem.file.loader'] = $serviceContainer->share(function($c) {
			return new \Message\Mothership\FileManager\File\Loader('Locale class', $c['db.query']);
		});

		$serviceContainer['filesystem.file.create'] = $serviceContainer->share(function($c) {
			return new \Message\Mothership\FileManager\File\Create(
				$c['cms.page.loader'],
				$c['db.query'],
				$c['event.dispatcher']
			);
		});

		$serviceContainer['filesystem.file.edit'] = $serviceContainer->share(function($c) {
			return new \Message\Mothership\FileManager\File\Edit(
				$c['db.query'],
				$c['event.dispatcher']
			);
		});


		// $serviceContainer['filesystem.file.edit'] = $serviceContainer->share(function($c) {
		// 	return new \Message\Mothership\FileManager\File\Delete(
		// 		$c['db.query'],
		// 		$c['event.dispatcher']
		// 	);
		// });
	}
}