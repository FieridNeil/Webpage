class Person{
  constructor(name, age, favColor){
    this.name = name;
    this.age = age;
    this.favColor = favColor;
  }

  GetInfo(){
    return this.name + " " + this.age + " " + this.favColor;
  }
}


var per1 = new Person("a", 12, "blue");
var info = per1.GetInfo();
console.log(info);
