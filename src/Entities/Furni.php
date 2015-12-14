<?php

/**
 * The entitymodel for a Furni object
 */

namespace HabboAPI\Entities;

use Carbon\Carbon;

/**
 * Class Furni
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Furni implements Entity
{

	//missing tradeble, recycleble, bc club
	private $type;
	private $id;
	private $swfFile;
	private $revision;
	private $var1;
	private $var2;
	private $var3;
	private $colors;
	private $name;
	private $description;
	private $var4;
	private $var5;
	private $var6;
	private $var7;
	private $var8;
	private $var9;
	private $var10;
	private $var11;
	private $var12;
	private $var13;
	private $var14;
	private $var15;
	private $iconUrl; //bonus by @DavydeVries

	/** Parses furni info array to \Entities\Furni object
	 *
	 * @param array $furni
	 */

	public function parse($furni)
	{
		$this->setType($furni[ 0 ]);
		$this->setId($furni[ 1 ]);
		$this->setSwfFile($furni[ 2 ]);
		$this->setRevision($furni[ 3 ]);
		$this->setVar1($furni[ 4 ]);
		$this->setVar2($furni[ 5 ]);
		$this->setVar3($furni[ 6 ]);
		$this->setColors($furni[ 7 ]);
		$this->setName($furni[ 8 ]);
		$this->setDescription($furni[ 9 ]);
		$this->setVar4($furni[ 10 ]);
		$this->setVar5($furni[ 11 ]);
		$this->setVar6($furni[ 12 ]);
		$this->setVar7($furni[ 13 ]);
		$this->setVar8($furni[ 14 ]);
		$this->setVar9($furni[ 15 ]);
		$this->setVar10($furni[ 16 ]);
		$this->setVar11($furni[ 17 ]);
		
		//something strange with wall items, is missing the 18,19,20 index in array.
		if(count($furni) != 22)
		{
			
			$this->setVar15($furni[ 18 ]);
		}else{
			$this->setVar12($furni[ 18 ]);
		}
		//empty by wall items.
		if(isset($furni[ 19 ]))
		{
			$this->setVar13($furni[ 19 ]);
		}
		if(isset($furni[ 20 ]))
		{
			$this->setVar14($furni[ 20 ]);
		}
		if(isset($furni[ 21 ]))
		{
			$this->setVar15($furni[ 21 ]);
		}
		
		$this->setIconUrl(); //bonus by @DavydeVries
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
	public function getSwfFile()
	{
		return $this->swfFile;
	}

	/**
	 * @param string $swfFile
	 */
	protected function setSwfFile($swfFile)
	{
		$this->swfFile = $swfFile;
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
	public function getVar1()
	{
		return $this->var1;
	}

	/**
	 * @param string $var1
	 */
	protected function setVar1($var1)
	{
		$this->var1 = $var1;
	}

	/**
	 * @return string
	 */
	public function getVar2()
	{
		return $this->var2;
	}

	/**
	 * @param string $var2
	 */
	protected function setVar2($var2)
	{
		$this->var2 = $var2;
	}

	/**
	 * @return string
	 */
	public function getVar3()
	{
		return $this->var3;
	}

	/**
	 * @param string $var3
	 */
	protected function setVar3($var3)
	{
		$this->var3 = $var3;
	}

	/**
	 * @return string
	 */
	public function getColors()
	{
		return $this->colors;
	}

	/**
	 * @param string $colors
	 */
	protected function setColors($colors)
	{
		$this->colors = $colors;
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
	public function getVar4()
	{
		return $this->var4;
	}

	/**
	 * @param string $var4
	 */
	protected function setVar4($var4)
	{
		$this->var4 = $var4;
	}

	/**
	 * @return string
	 */
	public function getVar5()
	{
		return $this->var5;
	}

	/**
	 * @param string $var5
	 */
	protected function setVar5($var5)
	{
		$this->var5 = $var5;
	}

	/**
	 * @return string
	 */
	public function getVar6()
	{
		return $this->var6;
	}

	/**
	 * @param string $var6
	 */
	protected function setVar6($var6)
	{
		$this->var6 = $var6;
	}

	/**
	 * @return string
	 */
	public function getVar7()
	{
		return $this->var7;
	}

	/**
	 * @param string $var7
	 */
	protected function setVar7($var7)
	{
		$this->var7 = $var7;
	}

	/**
	 * @return string
	 */
	public function getVar8()
	{
		return $this->var8;
	}

	/**
	 * @param string $var8
	 */
	protected function setVar8($var8)
	{
		$this->var8 = $var8;
	}

	/**
	 * @return string
	 */
	public function getVar9()
	{
		return $this->var9;
	}

	/**
	 * @param string $var9
	 */
	protected function setVar9($var9)
	{
		$this->var9 = $var9;
	}

	/**
	 * @return string
	 */
	public function getVar10()
	{
		return $this->var10;
	}

	/**
	 * @param string $var10
	 */
	protected function setVar10($var10)
	{
		$this->var10 = $var10;
	}

	/**
	 * @return string
	 */
	public function getVar11()
	{
		return $this->var11;
	}

	/**
	 * @param string $var11
	 */
	protected function setVar11($var11)
	{
		$this->var11 = $var11;
	}

	/**
	 * @return string
	 */
	public function getVar12()
	{
		return $this->var12;
	}

	/**
	 * @param string $var12
	 */
	protected function setVar12($var12)
	{
		$this->var12 = $var12;
	}

	/**
	 * @return string
	 */
	public function getVar13()
	{
		return $this->var13;
	}

	/**
	 * @param string $var13
	 */
	protected function setVar13($var13)
	{
		$this->var13 = $var13;
	}

	/**
	 * @return string
	 */
	public function getVar14()
	{
		return $this->var14;
	}

	/**
	 * @param string $var14
	 */
	protected function setVar14($var14)
	{
		$this->var14 = $var14;
	}

	/**
	 * @return string
	 */
	public function getVar15()
	{
		return $this->var15;
	}

	/**
	 * @param string $var15
	 */
	protected function setVar15($var15)
	{
		$this->var15 = $var15;
	}

	/**
	 * @return string
	 */
	public function getIconUrl()
	{
		return $this->iconUrl;
	}

	protected function setIconUrl()
	{
		$this->iconUrl = "http://habboo-a.akamaihd.net/dcr/hof_furni/".$this->revision."/".$this->swfFile."_icon.png";
	}

}
