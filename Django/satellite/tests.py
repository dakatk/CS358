from django.test import TestCase, Client
from .views import NUM_IMAGES


class SatelliteTestCases(TestCase):
    """Test cases for requests related to the satellite page"""
    
    def setUp(self):
        """Initialize test data"""
        
        self.num_images = NUM_IMAGES
        self.client = Client()
        

    def test_post_true_color(self):
        """Test the POST request response for channel=true_color"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': 'true_color'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_1_blue(self):
        """Test the POST request response for channel=1_blue"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': '1_blue'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_2_red(self):
        """Test the POST request response for channel=2_red"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': '2_red'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_4_nir(self):
        """Test the POST request response for channel=4_nir"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': '4_nir'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_9_wv(self):
        """Test the POST request response for channel=9_wv"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': '9_wv'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
        

    def test_post_14_longwave(self):
        """Test the POST request response for channel=14_longwave"""
        
        response = self.client.post('/satellite/image_desc/', {'channel': '14_longwave'})
        image_cycle = response.json()['image_cycle']

        self.assertEqual(type(image_cycle), list)
        self.assertEqual(len(image_cycle), self.num_images)
