from django import template

register = template.Library()

@register.filter(name="image_file")
def image_file(type_id, index):
    return "radar/%s/%s_img%i.png" % (type_id, type_id, index)

