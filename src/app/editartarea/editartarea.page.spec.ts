import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EditartareaPage } from './editartarea.page';

describe('EditartareaPage', () => {
  let component: EditartareaPage;
  let fixture: ComponentFixture<EditartareaPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(EditartareaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
