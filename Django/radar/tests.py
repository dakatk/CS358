from django.test import TestCase, Client
from .views import NUM_IMAGES

class RadarTestCase(TestCase):
    def setUp(self):
        self.num_images = NUM_IMAGES
        self.client = Client()

    def test_post_refl_images(self):
        response = self.client.post('/radar/image_desc/', {'radar_type': 'refl'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_vel_images(self):
        response = self.client.post('/radar/image_desc/', {'radar_type': 'vel'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)

    def test_post_zdr_images(self):
        response = self.client.post('/radar/image_desc/', {'radar_type': 'zdr'})
        image_cycle = response.json()['image_cycle']
        
        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
