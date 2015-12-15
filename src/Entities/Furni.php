<?php

/**
 * The entitymodel for a Furni object
 */

namespace HabboAPI\Entities;


/**
 * Class Furni
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Furni implements Entity
{

	private $type;
	private $id;
	private $className;
	private $revision;
	private $defaultDir;
	private $width;
	private $length;
	private $colors;
	private $name;
	private $description;
	private $offerId;
	private $buyOut;
	private $rentOfferId;
	private $rentBuyOut;
	private $bc;
	private $specialType;
	private $canStandOn;
	private $canSitOn;
	private $canLayOn;

    /** Parses furni info array to \Entities\Furni object
     *
     * @param array $furni
     */
	public function parse($furni)
	{
		$this->setType($furni[ '@attributes' ][ 'type' ]);
		$this->setId($furni[ '@attributes' ][ 'id' ]);
		$this->setClassName($furni[ '@attributes' ][ 'classname' ]);
		$this->setRevision($furni[ 'revision' ]);
		if(isset($furni[ 'defaultdir' ]))
		{
			$this->setDefaultDir($furni[ 'defaultdir' ]);
		}
		if(isset($furni[ 'xdim' ]))
		{
			$this->setWidth($furni[ 'xdim' ]);
		}
		if(isset($furni[ 'ydim' ]))
		{
			$this->setLength($furni[ 'ydim' ]);
		}
		if(isset($furni[ 'partcolors' ]))
		{
			$this->setColors((array) $furni[ 'partcolors' ]);
		}
		$this->setName($furni[ 'name' ]);
		$this->setDescription($furni[ 'description' ]);
		$this->setOfferId($furni[ 'offerid' ]);
		$this->setBuyOut($furni[ 'buyout' ]);
		$this->setRentOfferId($furni[ 'rentofferid' ]);
		$this->setRentBuyOut($furni[ 'rentbuyout' ]);
		$this->setBC($furni[ 'bc' ]);
		$this->setSpecialType($furni[ 'specialtype' ]);
		if($this->type == 'roomitemtypes')
		{
			$this->setCanStandOn($furni[ 'canstandon' ]);
			$this->setCanSitOn($furni[ 'cansiton' ]);
			$this->setCanLayOn($furni[ 'canlayon' ]);
		}
	}

	public function __toString()
	{
		return $this->getName();
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	protected function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	protected function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getClassName()
	{
		return $this->className;
	}

	/**
	 * @param string $className
	 */
	protected function setClassName($className)
	{
		$this->className = $className;
	}

	/**
	 * @return string
	 */
	public function getRevision()
	{
		return $this->revision;
	}

	/**
	 * @param string $revision
	 */
	protected function setRevision($revision)
	{
		$this->revision = $revision;
	}

	/**
	 * @return string
	 */
	public function getDefaultDir()
	{
		return $this->defaultDir;
	}

	/**
	 * @param string $defaultDir
	 */
	protected function setDefaultDir($defaultDir)
	{
		$this->defaultDir = $defaultDir;
	}

	/**
	 * @return string
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * @param string $xDim
	 */
	protected function setWidth($xDim)
	{
		$this->width = $xDim;
	}

	/**
	 * @return string
	 */
	public function getLength()
	{
		return $this->length;
	}

	/**
	 * @param string $length
	 */
	protected function setLength($length)
	{
		$this->length = $length;
	}

	/**
	 * @return array
	 */
	public function getColors()
	{
		return $this->colors;
	}

	/**
	 * @param string $partColors
	 */
	protected function setColors($partColors)
	{
		$this->colors = $partColors;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	protected function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	protected function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getOfferId()
	{
		return $this->offerId;
	}

	/**
	 * @param string $offerId
	 */
	protected function setOfferId($offerId)
	{
		$this->offerId = $offerId;
	}

	/**
	 * @return string
	 */
	public function getBuyOut()
	{
		return $this->buyOut;
	}

	/**
	 * @param string $buyOut
	 */
	protected function setBuyOut($buyOut)
	{
		$this->buyOut = $buyOut;
	}

	/**
	 * @return string
	 */
	public function getRentOfferId()
	{
		return $this->rentOfferId;
	}

	/**
	 * @param string $rentOfferId
	 */
	protected function setRentOfferId($rentOfferId)
	{
		$this->rentOfferId = $rentOfferId;
	}

	/**
	 * @return string
	 */
	public function getRentBuyOut()
	{
		return $this->rentBuyOut;
	}

	/**
	 * @param string $rentBuyOut
	 */
	protected function setRentBuyOut($rentBuyOut)
	{
		$this->rentBuyOut = $rentBuyOut;
	}

	/**
	 * @return string
	 */
	public function getBC()
	{
		return $this->bc;
	}

	/**
	 * @param string $bc
	 */
	protected function setBC($bc)
	{
		$this->bc = $bc;
	}

	/**
	 * @return string
	 */
	public function getSpecialType()
	{
		return $this->specialType;
	}

	/**
	 * @param string $specialType
	 */
	protected function setSpecialType($specialType)
	{
		$this->specialType = $specialType;
	}

	/**
	 * @return string
	 */
	public function getCanStandOn()
	{
		return $this->canStandOn;
	}

	/**
	 * @param string $canStandOn
	 */
	protected function setCanStandOn($canStandOn)
	{
		$this->canStandOn = $canStandOn;
	}

	/**
	 * @return string
	 */
	public function getCanSitOn()
	{
		return $this->canSitOn;
	}

	/**
	 * @param string $canSitOn
	 */
	protected function setCanSitOn($canSitOn)
	{
		$this->canSitOn = $canSitOn;
	}

	/**
	 * @return string
	 */
	public function getCanLayOn()
	{
		return $this->canLayOn;
	}

	/**
	 * @param string $canLayOn
	 */
	protected function setCanLayOn($canLayOn)
	{
		$this->canLayOn = $canLayOn;
	}

	/**
     * Generates a URL for the furni icon
     * Bonus by @DavydeVries
	 * @return string
	 */
	public function getIconUrl()
	{
        $icon_name = str_replace("*", "_", $this->className);
		return "http://habboo-a.akamaihd.net/dcr/hof_furni/".$this->revision."/".$icon_name."_icon.png";
	}

}
