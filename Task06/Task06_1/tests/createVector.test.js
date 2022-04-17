import createVector from '../src/index'

test('toString', () => {
  expect(createVector(-3, 15, 7).toString()).toBe('(-3;15;7)')
})

test('getLength', () => {
  expect(createVector(0, 4, 3).getLength()).toBe(5)
})

test('add', () => {
  const vector1 = createVector(4, 6, 7)
  const vector2 = createVector(2, 3, 1)
  expect(vector1.add(vector2).toString()).toBe('(6;9;8)')
})

test('sub', () => {
  const vector1 = createVector(4, 6, 7)
  const vector2 = createVector(2, 3, 1)
  expect(vector1.sub(vector2).toString()).toBe('(2;3;6)')
})

test('product', () => {
  expect(createVector(3, 2, -4).product(3).toString()).toBe('(9;6;-12)')
})

test('scalarProduct', () => {
  const vector1 = createVector(2, 4, 8)
  const vector2 = createVector(9, -3, 1)
  expect(vector1.scalarProduct(vector2)).toBe(14)
})

test('vectorProduct', () => {
  const vector1 = createVector(9, 4, -3)
  const vector2 = createVector(0, -2, 3)
  expect(vector1.vectorProduct(vector2).toString()).toBe('(6;-27;-18)')
})