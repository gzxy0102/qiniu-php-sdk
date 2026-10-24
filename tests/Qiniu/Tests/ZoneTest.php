<?php
namespace Qiniu\Tests;

use PHPUnit\Framework\TestCase;

use Qiniu;
use Qiniu\Zone;

class ZoneTest extends TestCase
{
    protected $zone;
    protected $zoneHttps;
    protected $ak;

    protected $bucketName;


    /**
     * @before
     */
    protected function setUpZoneAndBucket()
    {
        global $bucketName;
        $this->bucketName = $bucketName;

        global $accessKey;
        $this->ak = $accessKey;

        $this->zone = new Zone();
        $this->zoneHttps = new Zone('https');
    }

    public function testUpHosts()
    {
        list($ret, $err) = Zone::queryZone($this->ak, 'fakebucket');
        $this->assertNull($ret);
        $this->assertNotNull($err);

        $zone = Zone::queryZone($this->ak, $this->bucketName);
        $this->assertNotEmpty($zone->cdnUpHosts);
    }

    public function testIoHosts()
    {
        $zone = Zone::queryZone($this->ak, $this->bucketName);
        $this->assertNotEmpty($zone->iovipHost);
    }

    public function testZonez0()
    {
        $zone = Zone::zonez0();
        $this->assertContains('upload.qiniup.com', $zone->cdnUpHosts);
    }

    public function testZonez1()
    {
        $zone = Zone::zonez1();
        $this->assertContains('upload-z1.qiniup.com', $zone->cdnUpHosts);
    }

    public function testZonez2()
    {
        $zone = Zone::zonez2();
        $this->assertContains('upload-z2.qiniup.com', $zone->cdnUpHosts);
    }

    public function testZoneCnEast2()
    {
        $zone = Zone::zoneCnEast2();
        $this->assertContains('upload-cn-east-2.qiniup.com', $zone->cdnUpHosts);
    }

    public function testZoneNa0()
    {
        $zone = Zone::zoneNa0();
        $this->assertContains('upload-na0.qiniup.com', $zone->cdnUpHosts);
    }

    public function testZoneAs0()
    {
        $zone = Zone::zoneAs0();
        $this->assertContains('upload-as0.qiniup.com', $zone->cdnUpHosts);
    }

    public function testQvmZonez0()
    {
        $zone = Zone::qvmZonez0();
        $this->assertContains('free-qvm-z0-xs.qiniup.com', $zone->srcUpHosts);
    }

    public function testQvmZonez1()
    {
        $zone = Zone::qvmZonez1();
        $this->assertContains('free-qvm-z1-zz.qiniup.com', $zone->srcUpHosts);
    }
}
