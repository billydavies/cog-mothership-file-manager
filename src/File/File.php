<?php

namespace Message\Mothership\FileManager\File;

use Message\ImageResize\ResizableInterface;

use Message\Cog\ValueObject\Authorship;

/**
 * Represents the properties of a single File.
 *
 * @author Danny Hannah <danny@message.co.uk>
 */
class File implements ResizableInterface
{
	public $id;
	public $url;
	public $name;
	public $authorship;
	public $extension;
	public $fileSize;
	public $typeID;
	public $checksum;
	public $previewUrl;
	public $dimensionX;
	public $dimensionY;
	public $altText;
	public $duration;
	public $tags;

	public $file;

	public function __construct()
	{
		$this->authorship = new Authorship;
	}

	public function getUrl()
	{
		return $this->file->getPublicUrl();
	}

	public function getAltText()
	{
		return $this->altText;
	}

	/**
	 * Check if this file is "image" type.
	 *
	 * @return boolean True if this file is an image
	 */
	public function isTypeImage()
	{
		return Type::IMAGE === $this->typeID;
	}

	/**
	 * Check if this file is "document" type.
	 *
	 * @return boolean True if this file is a document
	 */
	public function isTypeDocument()
	{
		return Type::DOCUMENT === $this->typeID;
	}

	/**
	 * Check if this file is "video" type.
	 *
	 * @return boolean True if this file is a video
	 */
	public function isTypeVideo()
	{
		return Type::VIDEO === $this->typeID;
	}

	/**
	 * Check if this file is "other" type.
	 *
	 * @return boolean True if this file is another type of file
	 */
	public function isTypeOther()
	{
		return Type::OTHER === $this->typeID;
	}
}