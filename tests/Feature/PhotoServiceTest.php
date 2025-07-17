<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\PhotoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoServiceTest extends TestCase
{
    use RefreshDatabase;

    private PhotoService $photoService;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->photoService = new PhotoService();
        $this->user = User::factory()->create();
        
        // Create test directory
        if (!file_exists(public_path('profile-pictures'))) {
            mkdir(public_path('profile-pictures'), 0755, true);
        }
    }

    protected function tearDown(): void
    {
        // Clean up test files
        $testFiles = glob(public_path('profile-pictures/test_*'));
        foreach ($testFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        
        parent::tearDown();
    }

    /** @test */
    public function it_can_upload_valid_photo()
    {
        $file = UploadedFile::fake()->image('test.jpg', 100, 100);
        
        $filename = $this->photoService->uploadPhoto($this->user, $file);
        
        $this->assertNotNull($filename);
        $this->assertTrue($this->photoService->photoExists($filename));
        $this->assertStringContainsString('profile_' . $this->user->id, $filename);
    }

    /** @test */
    public function it_rejects_invalid_file_types()
    {
        $file = UploadedFile::fake()->create('test.txt', 100);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Format file tidak didukung');
        
        $this->photoService->uploadPhoto($this->user, $file);
    }

    /** @test */
    public function it_rejects_oversized_files()
    {
        // Create a file larger than 10MB
        $file = UploadedFile::fake()->create('test.jpg', 11 * 1024); // 11MB
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Ukuran file terlalu besar');
        
        $this->photoService->uploadPhoto($this->user, $file);
    }

    /** @test */
    public function it_deletes_old_photo_when_uploading_new_one()
    {
        // Upload first photo
        $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
        $filename1 = $this->photoService->uploadPhoto($this->user, $file1);
        $this->user->photo = $filename1;
        
        // Upload second photo
        $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);
        $filename2 = $this->photoService->uploadPhoto($this->user, $file2);
        
        $this->assertFalse($this->photoService->photoExists($filename1));
        $this->assertTrue($this->photoService->photoExists($filename2));
    }

    /** @test */
    public function it_can_save_cropped_photo_from_base64()
    {
        // Create a simple base64 image data
        $imageData = base64_encode('fake-image-data');
        $base64Data = 'data:image/jpeg;base64,' . $imageData;
        
        // Mock the actual image saving since we're using fake data
        $originalPhoto = 'original_photo.jpg';
        
        $filename = $this->photoService->saveCroppedPhoto($this->user, $base64Data, $originalPhoto);
        
        $this->assertNotNull($filename);
        $this->assertStringContainsString('cropped', $filename);
    }

    /** @test */
    public function it_generates_correct_photo_url()
    {
        $filename = 'test_photo.jpg';
        $url = $this->photoService->getPhotoUrl($filename);
        
        $this->assertStringContainsString('profile-pictures/test_photo.jpg', $url);
    }

    /** @test */
    public function it_returns_null_for_empty_filename()
    {
        $url = $this->photoService->getPhotoUrl(null);
        $this->assertNull($url);
        
        $url = $this->photoService->getPhotoUrl('');
        $this->assertNull($url);
    }
}