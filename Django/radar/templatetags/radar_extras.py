from django import template

IMAGE_STATIC = 'images/radar'

register = template.Library()

@register.filter(name='image_file')
def image_file(type_id, index):
    global IMAGE_STATIC
    return IMAGE_STATIC + ('/%s/%s_img%i.png' % (type_id, type_id, index))

