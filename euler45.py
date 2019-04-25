def triangle(start, stop):
    
    while start < stop:
        
        yield (start * (start + 1)) / 2
        start += 1


def pentagonal(start, stop):

    while start < stop:

        yield (start * (3 * start - 1)) / 2
        start += 1


def hexagonal(start, stop):

    while start < stop:

        yield start * (2 * start - 1)
        start += 1


for t in triangle(286, 400):
    for p in pentagonal(165, 250):
        for h in hexagonal(143, 200):
            if t == p and p == h:
                print(t)


# (n(n + 1) / 2) - (m(3m - 1) / 2) - l(2l - 1) = 0
