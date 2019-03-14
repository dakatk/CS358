from django.test import TestCase, Client
from .views import NUM_IMAGES


class RadarTestCase(TestCase):
    """Test cases for requests related to the radar page"""
    
    def setUp(self):
        """Initialize test data"""
        
        self.num_images = NUM_IMAGES
        self.client = Client()
        

    def test_post_ref_images(self):
        """Test the POST request response for radar_type=ref"""
        
        response = self.client.post('/radar/image_desc/', {'radar_type': 'ref'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_vel_images(self):
        """Test the POST request response for radar_type=vel"""
        
        response = self.client.post('/radar/image_desc/', {'radar_type': 'vel'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_zdr_images(self):
        """Test the POST request response for radar_type=zdr"""
        
        response = self.client.post('/radar/image_desc/', {'radar_type': 'zdr'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
