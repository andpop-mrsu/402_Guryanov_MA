import Vector from '../src/index'

test('toString', () => {
  expect(new Vector(-3, 15, 7).toString()).toBe('(-3;15;7)')
})

test('getLength', () => {
  expect(new Vector(0, 4, 3).getLength()).toBe(5)
})

test('add', () => {
  const vector1 = new Vector(4, 6, 7)
  const vector2 = new Vector(2, 3, 1)
  expect(vector1.add(vector2).toString()).toBe('(6;9;8)')
})

test('sub', () => {
  const vector1 = new Vector(4, 6, 7)
  const vector2 = new Vector(2, 3, 1)
  expect(vector1.sub(vector2).toString()).toBe('(2;3;6)')
})

test('product', () => {
  expect(new Vector(3, 2, -4).product(3).toString()).toBe('(9;6;-12)')
})

test('scalarProduct', () => {
  const vector1 = new Vector(2, 4, 8)
  const vector2 = new Vector(9, -3, 1)
  expect(vector1.scalarProduct(vector2)).toBe(14)
})

test('vectorProduct', () => {
  const vector1 = new Vector(9, 4, -3)
  const vector2 = new Vector(0, -2, 3)
  expect(vector1.vectorProduct(vector2).toString()).toBe('(6;-27;-18)')
})